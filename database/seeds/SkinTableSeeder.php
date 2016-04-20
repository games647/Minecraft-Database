<?php

use Illuminate\Database\Seeder;

class SkinTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        App\Skin::create([
            'timestamp' => date('Y-m-d H:i:s', 1461089757),
            'profileId' => "069a79f4-44e9-4726-a5be-fca90e38aaf5",
            'profileName' => "Notch",
            'skinUrl' => "http://textures.minecraft.net/texture/"
            . "a116e69a845e227f7ca1fdde8c357c8c821ebd4ba619382ea4a1f87d4ae94",
            'capeUrl' => "http://textures.minecraft.net/texture/"
            . "eec3cabfaeed5dafe61c6546297e853a547c39ec238d7c44bf4eb4a49dc1f2c0",
            'signature' => base64_decode("bcJDzQR0isUvV4/z4TZpR7nqJeNhBowl2k/z3LOdHGPW38uOnCheGEAe/f/A5ukKD7ioRZ9Yz0thx"
                    . "UbZOr1qCpCiyYSfLzBkBd++WYuVdYZn9CVQFGBVj75cQccsqf5b4xAboPdNS70naM/5Qz3vJQOMNifEEUB50IUmx5Jnir7k9"
                    . "/Awu5n1A0+g33wLggvfG6AXwLzdi1xjwmjURuqwL5Q3Z73DSSeyFZM1M5kfYcLZqPh0XN44MUdeL4DAEKs9Q7j372n9FZbzp"
                    . "s4zaY3+BDz9gkX67B2otWPa5iHLyoFESDWEc4IfSw1P6+dnTcatPbFlwtYFVra6yHPZg2a9kd9LeLXOIYdGAfOkqGIlCoy1W"
                    . "8I59wcXkkDL6LrT9aoD03yz77BLWL5DspIhQx06SKjHVA38G85TxmpxAGlS2LLWlDOE+uDMBfjeU3EvEzxNTEGLvPsbAD5Sn"
                    . "Fzpj9XHIree6zv57P9hMA/48mbaWd60mi1GHdJCAYBMzqrBBVZiRkzhGmUIj2OFTDn7cSy7e2cCkAPJRnD07FI3PXkLhhoZl"
                    . "1vybhIrlkDOuldXgssyesPCixrvTF+Q/s2nkz82vbyTsZq6k2b5D3FsxR9odnilmVuJVGIW5q1Kx91v5emna1BiFkQ4Pd3B6"
                    . "vf5wHB83c+sms8zCVO+71MtVmdSpZM=", true)
        ])->save();

        App\Skin::create([
            'timestamp' => date('Y-m-d H:i:s', 1461089586),
            'profileId' => "61699b2e-d327-4a01-9f1e-0ea8c3f06bc6",
            'profileName' => "Dinnerbone",
            'skinUrl' => "http://textures.minecraft.net/texture/"
            . "cd6be915b261643fd13621ee4e99c9e541a551d80272687a3b56183b981fb9a",
            'capeUrl' => "http://textures.minecraft.net/texture/"
            . "eec3cabfaeed5dafe61c6546297e853a547c39ec238d7c44bf4eb4a49dc1f2c0",
            'signature' => base64_decode("e0ztBecWgTZrxqSCzdso8+gxsaWWDTrlH2VYtPFCM895SbKRssSdQ3DMtVMpvnZWGUHNjNjpYvB9B"
                    . "IycT6W1B4SYVG794Oxqn08so0/rrnkh8ppsY+TB7sUphdzNvrMvteI2HynLy/IW27eI+kIaBh1lL6PwwF+6UcJ7BLRsZaLqT"
                    . "vm60NAvaBezrkLRI78xEhQqOHeoCmtVANkpfVXKiQ0VUOHYvPmwzNB8gWo47YRcJuvet+cw8+02AOI9rB9ggiH8lNPn9mK2H"
                    . "kiietHHGfY57E5ZTKE7YFviodkJJ2B6mhr2YD8NL6m2VJNWywHpibITfi0GCD0CkC9Zxwz67aGTjNN+kPkVDeuALE4Akm90t"
                    . "Z9el8tg80K+UFRgC9GK4qVzUyi1lIXk9csYyWlcJUSq9uiUw/v5rwtRpbpzXfWTwYISvx2E+L46zinL9ibZmCTywEWaSuog6"
                    . "97B3cduwWq0z8/OJw09/gA6WPh9SnQX+bSD0UZmwmvQ1T3Uoh8j8cMmQUdhgfXxo+Q5wSMx9Zj0nZWILIUPdg0nUHqNZ6Lhz"
                    . "IbmvUE8WSdHis2+LW0P/RqQFT6rX4wMqK7VWDd3MbF1CS3H7PSt8KL4hcjvermUlpX/PR8tjZbQhNN6i3dLUWg8rGz3Me11w"
                    . "wXIXVe6lpOVcHsVc1+ztAeqSqSbTW8=", true)
        ])->save();
    }
}
