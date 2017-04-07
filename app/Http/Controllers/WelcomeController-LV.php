<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;



class WelcomeController extends Controller
{
    /**
	* GET
    * /
	*/
    public function __invoke(Request $request) {

              # Laravel Validation that all input meets requirements
              # I wonder if other people found lots of issues with Laravel Validation
              # I could submit a bug report to them at least ten lines long
              $err=$this->validate($request, [
                  'length' => 'required',
                  'length' => 'integer',
                  'length' => 'min:7',
                  'length' => 'max:12',
                  'includeCapitals' => 'required_without_all:includeLowers,includeNumbers,includeSymbols',
                  'includeLowers' => 'required_without_all:includeCapitals,includeNumbers,includeSymbols',
                  'includeNumbers' => 'required_without_all:includeCapitals,includeLowers,includeSymbols',
                  'includeSymbols' => 'required_without_all:includeCapitals,includeLowers,includeNumbers',
                  'lastChar' => 'max:1',

              ]);
              dump($err);

              $length = $request->input('length', null);
              $lengthMin = 7;
              $lengthMax = 12;
              $includeCapitals = $request->has('includeCapitals', null);
              $includeLowers = $request->has('includeLowers', null);
              $includeNumbers = $request->has('includeNumbers', null);
              $includeSymbols = $request->has('includeSymbols', null);
              $lastChar = $request->input('lastChar', null);
              $finalPassword = 'default';

              if (!empty($length) && $length >=$lengthMin && $length <=$lengthMax) {
              dump($request->all());
              $finalPassword = $this->generatePassword($request);
          }

      #  }

        return view('welcome')->with([
            'length' => $length,
            'lengthMin' => $lengthMin,
            'lengthMax' => $lengthMax,
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
        #$valCheckbox = false;
        $lastChar = $request->input('lastChar', null);

        $lettersCapitals = range('A', 'Z');
        $lettersLowers = range('a', 'z');
        $numbers = range('0', '9');
        $symbols = [ ')','!','@','#','$','%','^','&','*','(', ':',';','/','~','.' ];

        $possibleValues=[];
        $finalPassword='';

      #if ($length != null ) {
        dump($length);

        if ($includeCapitals != null) {
            $possibleValues = array_merge($possibleValues, $lettersCapitals);
            #$valCheckbox = true;
        }

        if ($includeLowers != null) {
            $possibleValues = array_merge($possibleValues, $lettersLowers);
            #$valCheckbox = true;
        }

        if ($includeNumbers != null) {
            $possibleValues = array_merge($possibleValues, $numbers);
            #$valCheckbox = true;
        }

        if ($includeSymbols != null) {
            $possibleValues = array_merge($possibleValues, $symbols);
            #$valCheckbox = true;
        }

        #if ($valCheckbox == true) {
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
      /*  }
        else {
          $finalPassword='You must check one checkbox';
        }*/

        dump($finalPassword);

    /*}
    else {
      $finalPassword='You must enter a valid length';
    }*/

    return $finalPassword;
}
}
