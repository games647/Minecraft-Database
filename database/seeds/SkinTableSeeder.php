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
            'timestamp' => 1461163718120,
            'profile_id' => "61699b2e-d327-4a01-9f1e-0ea8c3f06bc6",
            'profile_name' => "Dinnerbone",
            'skin_url' => "http://textures.minecraft.net/texture/"
            . "cd6be915b261643fd13621ee4e99c9e541a551d80272687a3b56183b981fb9a",
            'cape_url' => "http://textures.minecraft.net/texture/"
            . "eec3cabfaeed5dafe61c6546297e853a547c39ec238d7c44bf4eb4a49dc1f2c0",
            'signature' => base64_decode("FjF5sk3ZC6mUEV9Z3QMNIFsmudgdhf2sSSy8bR/5fmAeg8df/o8nth28uk4gFADUoydhcCzB8fW2b"
                    . "Fcr32pb9ujw0i6D/nX82mBhENjU29YZ5b7mCzdmNW2zH04tIDoF3mRLw2Arn+NovwoUJmSo4g/QVsT0GbQGIMaRpKzW4YTn8"
                    . "s261mknEaHfpw1UCcBop6sTTW3gK8ajfHt4gPC5skZWXCmfdgokR5pmDJSu9YrKRMwi4mjj3vy4t7+mJizyz2USFFXlXztTS"
                    . "ns2HRINzunElYK7GW/VbQWtyEMXU0j7FL2p8hom9oyNf7cN3jydTWQrj2d+Ra3f0oYv41Ersa/LMe7WfUHY5EA/0s4JrwoMk"
                    . "yOaFFvRlGLJjx6Q8xz6PHg/jILQyKu8pg0eKonPk15w/anbnkMhe6LaP8+6KgnQ0dvu8t6s3EsderMOoAuimYPZqgNWufqlv"
                    . "tEQgpcr9Rcg9Wg0eE0EwJbklbQMPGL1krl1jh4M7l33YMKkZ7qq+pkZuPm9+X+lwmtwM57uBPiRg6QTn9imHY7c+YZeWC+wu"
                    . "rp69qBzGUHq9dxSbA2OTQwIT+JmvR14Swh1qQR9BOQFMXdd0BKmAyUPUhdAjiu7jbPLahemQ7SZ653FTxs/jPlkq+C2tLqwv"
                    . "DFHWgjFQWxva9DD7PD4aDCMly3TLnI=", true)
        ])->save();
    }
}
