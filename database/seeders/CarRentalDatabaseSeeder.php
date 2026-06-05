<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class CarRentalDatabaseSeeder extends Seeder
{
    /**
     * Run the car rental SQL dump.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path('_carrental_db_.sql');

        if (! file_exists($path)) {
            throw new RuntimeException("SQL file not found: {$path}");
        }

        $sql = file_get_contents($path);
        $statements = $this->parseSqlStatements($sql);

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($statements as $statement) {
            if ($statement === '') {
                continue;
            }

            DB::unprepared($statement);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Parse a phpMyAdmin-style SQL dump into executable statements.
     *
     * @param  string  $sql
     * @return array<int, string>
     */
    private function parseSqlStatements(string $sql): array
    {
        $statements = [];
        $delimiter = ';';
        $buffer = '';

        foreach (preg_split('/\R/', $sql) as $line) {
            $trimmed = trim($line);

            if ($trimmed === '' || strpos($trimmed, '--') === 0) {
                continue;
            }

            if (preg_match('/^DELIMITER\s+(.+)$/i', $trimmed, $matches)) {
                if (trim($buffer) !== '') {
                    $statements[] = $this->normalizeStatement($buffer, $delimiter);
                    $buffer = '';
                }

                $delimiter = trim($matches[1]);
                continue;
            }

            $buffer .= $line."\n";

            if ($this->lineEndsWithDelimiter(rtrim($line), $delimiter)) {
                $statements[] = $this->normalizeStatement($buffer, $delimiter);
                $buffer = '';
            }
        }

        if (trim($buffer) !== '') {
            $statements[] = $this->normalizeStatement($buffer, $delimiter);
        }

        return array_values(array_filter(array_map(function (string $statement) {
            $statement = trim($statement);

            if ($statement === '') {
                return null;
            }

            // Avoid DEFINER privilege issues across environments.
            $statement = preg_replace(
                '/CREATE\s+DEFINER\s*=\s*[^ ]+\s+PROCEDURE/i',
                'CREATE PROCEDURE',
                $statement
            );

            return $statement;
        }, $statements)));
    }

    private function lineEndsWithDelimiter(string $line, string $delimiter): bool
    {
        if ($delimiter === ';') {
            return substr($line, -1) === ';';
        }

        $delimiterLength = strlen($delimiter);

        return strlen($line) >= $delimiterLength
            && substr($line, -$delimiterLength) === $delimiter;
    }

    private function normalizeStatement(string $statement, string $delimiter): string
    {
        $statement = trim($statement);

        if ($delimiter !== ';') {
            $pattern = '/'.preg_quote($delimiter, '/').'\s*$/';

            return trim(preg_replace($pattern, '', $statement));
        }

        return rtrim($statement, " \t\n\r\0\x0B;").';';
    }
}
