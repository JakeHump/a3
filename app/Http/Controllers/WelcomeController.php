<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Rych\Random\Random;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    /**
	* GET
    * /
	*/
    public function __invoke(Request $request) {

          $length = $request->input('length', null);
          $includeCapitals = $request->has('includeCapitals', null);
          $includeLowers = $request->has('includeLowers', null);
          $includeNumbers = $request->has('includeNumbers', null);
          $includeSymbols = $request->has('includeSymbols', null);
          $lastChar = $request->input('lastChar', null);

          $finalPassword = 'default';

          if (!empty($length)) {
            dump($request->all());
            $finalPassword = $this->generatePassword($request);
          }

        return view('welcome')->with([
            'length' => $length,
            'includeCapitals' => $includeCapitals,
            'includeLowers' => $includeLowers,
            'includeNumbers' => $includeNumbers,
            'includeSymbols' => $includeSymbols,
            'lastChar' => $lastChar,
            'finalPassword' => $finalPassword
        ]);
    }

    public function generatePassword(Request $request) {

        $length = $request->input('length', null);
        $includeCapitals = $request->has('includeCapitals', null);
        $includeLowers = $request->has('includeLowers', null);
        $includeNumbers = $request->has('includeNumbers', null);
        $includeSymbols = $request->has('includeSymbols', null);
        $lastChar = $request->input('lastChar', null);

        $lettersCapitals = range('A', 'Z');
        $lettersLowers = range('a', 'z');
        $numbers = range('0', '9');
        $symbols = [ ')','!','@','#','$','%','^','&','*','(', ':',';','/','~','.' ];

        $possibleValues=[];
        $finalPassword='';

      if ($length != null ) {
        dump($length);

        if ($includeCapitals != null) {
            $possibleValues = array_merge($possibleValues, $lettersCapitals);
        }

        if ($includeLowers != null) {
            $possibleValues = array_merge($possibleValues, $lettersLowers);
        }

        if ($includeNumbers != null) {
            $possibleValues = array_merge($possibleValues, $numbers);
        }

        if ($includeSymbols != null) {
            $possibleValues = array_merge($possibleValues, $symbols);
        }

        dump($possibleValues);

        for ($i = 0; $i<$length; $i++) {
            if ($i==$length-1 and $lastChar!=null) {
                $finalPassword = $finalPassword.$lastChar;
            }
            else {
                $key=array_rand($possibleValues, 1);
                $finalPassword = $finalPassword.$possibleValues[$key];
            }
        }

        dump($finalPassword);
        return $finalPassword;
    }

}
}
