jQuery(window).on("load", function(){
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure you want to perform this operation?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
});
$(function(){
    var current = window.location;
    $('#nav li a').each(function(){
        var $this = $(this);
        // if the current path is like this link, make it active
        if($this.attr('href') == current){
            $this.addClass('active');
        }
        /* if($this.attr('href').indexOf(current) !== -1){
            $this.addClass('active');
        } */
    })
})
