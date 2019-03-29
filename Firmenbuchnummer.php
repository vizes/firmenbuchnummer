<?php
/**
 * User: Jan
 * Date: 29.03.2019
 * Time: 11:56
 */

namespace Vizes\Firmenbuchnummer;

class Firmenbuchnummer
{
    private $keytable = [
        'A', 'B', 'D', 'F', 'G', 'H',
        'I', 'K', 'M', 'P', 'S', 'T',
        'V', 'W', 'X', 'Y', 'Z'
    ];

    private $numberWeight = [
        6, 4, 14, 15, 10, 1
    ];

    public static function check($fn = null)
    {
        if ($fn != null) {
            $fnr = new Firmenbuchnummer();
            return $fnr->checkFN($fn);
        }

        return false;
    }

    public function checkFN($fn)
    {
        $sum = 0;

        // split input
        $numbersFn = substr($fn,0,-1);
        $stringFn = substr($fn,-1);

        //
        for($i=0; $i<strlen($numbersFn);$i++) {
            $sum += (int)$numbersFn[$i] * $this->numberWeight[$i];
        }

        $sumModulo = $sum % 17;

        if($this->keytable[$sumModulo] == strtoupper($stringFn)) {
            return true;
        }

        return false;
    }

}