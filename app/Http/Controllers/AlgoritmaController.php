<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlgoritmaController extends Controller
{

    // 3. Task 3: buat script untuk menampilkan bilangan fibonaci
    // 4. Task 4: buat function sederhana untuk enkripsi dekripsi suatu kalimat,

    // invite github swidodo009@gmail.com

    public function algoritma()
    {
        $data = [5, 4, 1, 6, 8, 9, 7, 6, 3, 8, 7, 8, 10];
        $numbers = [12, 7, 9, 14, 6, 3, 8, 10, 5, 4];

        // script untuk menampilkan sema elemen dalam array yang lebih dari 6
        $dataResult = [];
        foreach ($data as $key => $value) {
            if ($value > 6) {
                $dataResult[] = $value;
            }
        }

        // hitung berapa banyak bilangan genap dalam array numbers
        $evenNumber = 0;
        foreach ($numbers as $key => $value) {
            if ($value % 2 == 0) {
                $evenNumber++;
            }
        }

        // buat script untuk menampilkan bilangan fibonaci
        $fibonacci = [];
        $fibonacci[0] = 0;
        $fibonacci[1] = 1;
        for ($i = 2; $i < 10; $i++) {
            $fibonacci[$i] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
        }
        // dd($evenNumber);

        return view('algoritma', compact('dataResult', 'evenNumber', 'fibonacci'));
    }

    public function enkripsi()
    {
        return view('enkripsi');
    }

    public function enkripsiDekripsi(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'type' => 'required|in:encrypt,decrypt',
        ]);

        $text = $request->text;
        $type = $request->type;
        $shift = 3;

        $result = '';

        // di loop dulu
        for ($i = 0; $i < strlen($text); $i++) {
            $char = $text[$i];

            if (ctype_alpha($char)) {
                $ascii = ord(strtolower($char));
                // cek besar kecil
                $isUpper = ctype_upper($text[$i]);

                if ($type == 'encrypt') {
                    $shifted = (($ascii - 97 + $shift) % 26) + 97;
                } else {
                    $shifted = (($ascii - 97 - $shift + 26) % 26) + 97;
                }

                $newChar = chr($shifted);
                $result .= $isUpper ? strtoupper($newChar) : $newChar;
            } else {
                $result .= $char;
            }
        }

        return back()->with('result', $result);
    }
}
