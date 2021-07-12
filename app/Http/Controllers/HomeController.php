<?php

namespace App\Http\Controllers;

require (base_path('vendor/iyzico/iyzipay-php/IyzipayBootstrap.php'));

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use IyzipayBootstrap;
use App\Models\Office;
use App\Models\Vclass;
use App\Models\Vehicle;
use App\Models\Fueltype;
use App\Models\Geartype;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Mail\SendUserRegistered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $offices = Office::all();
        $vehicles = Vehicle::inRandomOrder()->limit(6)->get();
        return view('home.index',compact(array_keys(get_defined_vars())));
    }
    public function about()
    {
        return view('home.about');
    }
    public function offices(){
        $offices = Office::latest()->paginate(20);
        $locations = Office::all();
        return view('home.offices',compact(array_keys(get_defined_vars())));
    }
    public function vehicles(){
        $vehicles = Vehicle::latest()->paginate(20);
        return view('home.vehicles',compact(array_keys(get_defined_vars())));
    }
    public function reservation(Request $request)
    {
        $pick_up_office = Office::find($request->pick_up_office_id);
        $offices = Office::all();
        if(!$request->step){
            return redirect(route('home.reservation',['step'=>'reservation']));
        }
        if($request->step == 'vehicle'){
            $vclasses = Vclass::all();
            $geartypes = Geartype::all();
            $fueltypes = Fueltype::all();
            $vehicles = $pick_up_office->activeVehicles;
            if($request->vclass){
                $vehicles = $vehicles->whereIn('vclass_id',$request->vclass);
            }
            if($request->geartype){
                $vehicles = $vehicles->whereIn('geartype_id',$request->geartype);
            }
            if($request->fueltype){
                $vehicles = $vehicles->whereIn('fueltype_id',$request->fueltype);
            }
        }
        if($request->step == 'checkout'){
            $pick_up_office = Office::find($request->pick_up_office_id);
            $drop_off_office = $request->drop_off_office_id ? Office::find($request->drop_off_office_id) : new Office;
            $vehicle = $pick_up_office->activeVehicles()->find($request->vehicle_id);
        }
        return view('home.reservation',compact(array_keys(get_defined_vars())));
    }

    public function checkout(Request $request){
        //return dd($request->all());
        if(!Auth::check()){
            $_user = $request->user;
            $password = rand(100000,999999);
            $_user['password'] = Hash::make($password);
            $_user['role_id'] = Role::where('name','client')->first()->id;
            $user = User::create($_user);
            if($request->completeSubscription){
                Mail::to($user->email)->send(new SendUserRegistered($user->email,$password));
            }
        }else{
            $user = Auth::user();
        }
        $reservation = Reservation::create($request->reservation);
        $reservation->status = 'pending';
        $reservation->trackNumber =  strtoupper(uniqid());
        $reservation->deposit = Office::find($request->reservation['pick_up_office_id'])->vehicles()->find($request->reservation['vehicle_id'])->pivot->deposit;
        $reservation->cost = Office::find($request->reservation['pick_up_office_id'])->vehicles()->find($request->reservation['vehicle_id'])->pivot->cost;
        $reservation->total = bcmul(Office::find($request->reservation['pick_up_office_id'])->vehicles()->find($request->reservation['vehicle_id'])->pivot->cost, $request->reservation['days'], 2) + bcmul(bcmul(Office::find($request->reservation['pick_up_office_id'])->vehicles()->find($request->reservation['vehicle_id'])->pivot->cost, $request->reservation['days'], 2),'0.18',2);
        $reservation->toPay = bcmul(Office::find($request->reservation['pick_up_office_id'])->vehicles()->find($request->reservation['vehicle_id'])->pivot->cost, $request->reservation['days'], 2) + bcmul(Office::find($request->reservation['pick_up_office_id'])->vehicles()->find($request->reservation['vehicle_id'])->pivot->deposit, '1', 2) + bcmul(bcmul(Office::find($request->reservation['pick_up_office_id'])->vehicles()->find($request->reservation['vehicle_id'])->pivot->cost, $request->reservation['days'], 2),'0.18',2);
        $reservation->client_id = $user->id;
        $reservation->save();

        $billingInformation = $request->billingInformation;
        $billingInformation['reservation_id'] = $reservation->id;
        $reservation->billingInformation()->create($billingInformation);

        return $this->getCheckoutForm($reservation);
    }

    public function getCheckoutForm(Reservation $reservation){

        IyzipayBootstrap::init();

        $options = new \Iyzipay\Options();
        $options->setApiKey(env('IYZICO_API_KEY'));
        $options->setSecretKey(env('IYZICO_SECURITY_KEY'));
        $options->setBaseUrl(env('IYZICO_BASE_URL'));

        $request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setConversationId("123456789");
        $request->setPrice($reservation->toPay);
        $request->setPaidPrice($reservation->toPay);
        $request->setCurrency(\Iyzipay\Model\Currency::TL);
        $request->setBasketId(uniqid());
        $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
        $request->setCallbackUrl(env('APP_URL').'/reservation/checkout/paymentCallback'.'?reservation='.$reservation->id);
        $request->setEnabledInstallments(array(2, 3, 6, 9));

        $buyer = new \Iyzipay\Model\Buyer();
        $buyer->setId("BY789");
        $buyer->setName($reservation->client->name);
        $buyer->setSurname("Surname");
        $buyer->setGsmNumber($reservation->client->tel ? $reservation->client->tel : 'No Data');
        $buyer->setEmail($reservation->client->email);
        $buyer->setIdentityNumber(uniqid());
        $buyer->setLastLoginDate("2021-10-21 12:10:00");
        $buyer->setRegistrationDate("2021-10-21 12:01:00");
        $buyer->setRegistrationAddress($reservation->client->address ? $reservation->client->address : 'No Data');
        $buyer->setIp($_SERVER['REMOTE_ADDR']);
        $buyer->setCity("Istanbul");
        $buyer->setCountry("Turkey");
        $buyer->setZipCode("34732");
        $request->setBuyer($buyer);

        $shippingAddress = new \Iyzipay\Model\Address();
        $shippingAddress->setContactName($reservation->billingInformation->name." ".$reservation->billingInformation->surname);
        $shippingAddress->setCity("Istanbul");
        $shippingAddress->setCountry("Turkey");
        $shippingAddress->setAddress($reservation->billingInformation->address);
        $shippingAddress->setZipCode("34742");
        $request->setShippingAddress($shippingAddress);

        $billingAddress = new \Iyzipay\Model\Address();
        $billingAddress->setContactName($reservation->billingInformation->name." ".$reservation->billingInformation->surname);
        $billingAddress->setCity("Istanbul");
        $billingAddress->setCountry("Turkey");
        $billingAddress->setAddress($reservation->billingInformation->address);
        $billingAddress->setZipCode("34742");
        $request->setBillingAddress($billingAddress);

        $basketItems = array();
        $firstBasketItem = new \Iyzipay\Model\BasketItem();
        $firstBasketItem->setId("BI101");
        $firstBasketItem->setName($reservation->vehicle->name);
        $firstBasketItem->setCategory1("Car Rental");
        $firstBasketItem->setCategory2($reservation->vehicle->vclass->name);
        $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
        $firstBasketItem->setPrice($reservation->toPay);
        $basketItems[0] = $firstBasketItem;
        $request->setBasketItems($basketItems);
        /* $payment = \Iyzipay\Model\Payment::create($request, $options); */
        $checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($request, $options);
        /* print_r($checkoutFormInitialize); */
        return view('home.checkout',compact("checkoutFormInitialize"));
    }


    public function paymentCallback(Request $request){

        $options = new \Iyzipay\Options();
        $options->setApiKey(env('IYZICO_API_KEY'));
        $options->setSecretKey(env('IYZICO_SECURITY_KEY'));
        $options->setBaseUrl(env('IYZICO_BASE_URL'));

        $request1 = request();
        $token = $request1->get('token');

        $request = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setConversationId("123456789");
        $request->setToken($token);

        $checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($request, $options);
        $control2 = $checkoutForm->getBasketId();
        $status1 = $checkoutForm->getStatus();
        $status2 = $checkoutForm->getPaymentStatus();
        $status3 = $checkoutForm->getErrorMessage();
        $paymentId = $checkoutForm->getPaymentId();
        $iyizicoFee = $checkoutForm->getIyziCommissionFee();
        $iyizico = $checkoutForm->getIyziCommissionRateAmount();
        $taksit = $checkoutForm->getInstallment();

        $reservation = Reservation::find(request()->get('reservation'));

        if($status1 == "success" && $reservation->id)
        {
            if($status2 == "SUCCESS")
            {
                $reservation->status = 'paid';
                $reservation->save();
                return view('home.paymentCallback',compact("reservation"));
            }
            else
            {
              return redirect(route('home'))->with('error',$status3);
            }
        }
        else
        {
            return redirect(route('home'))->with('error',$status3);
        }
    }

    public function track(){
        return view('home.reservationTrack');
    }

    public function trackResult(Request $request){
        $reservation = Reservation::where('trackNumber',$request->trackNumber)->first();
        if(!$reservation){
            return back()->with('error','Reservation not found');
        }
        return view('home.reservationTrackResult',compact("reservation"));
    }
}
