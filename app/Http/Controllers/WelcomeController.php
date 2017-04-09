<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;



class WelcomeController extends Controller
{

    public function __invoke(Request $request) {

        # Laravel Validation that all input meets requirements
        $this->validate($request, [
            'length' => 'required|numeric|min:7|max:12',
            'includeCapitals' => 'required_without_all:includeLowers,includeNumbers,includeSymbols',
            'includeLowers' => 'required_without_all:includeCapitals,includeNumbers,includeSymbols',
            'includeNumbers' => 'required_without_all:includeCapitals,includeLowers,includeSymbols',
            'includeSymbols' => 'required_without_all:includeCapitals,includeLowers,includeNumbers',
            'lastChar' => 'max:1',
        ]);

        # collect data from the form submission
        $length = $request->input('length', null);
        $lengthMin = 7;
        $lengthMax = 12;
        $includeCapitals = $request->has('includeCapitals', null);
        $includeLowers = $request->has('includeLowers', null);
        $includeNumbers = $request->has('includeNumbers', null);
        $includeSymbols = $request->has('includeSymbols', null);
        $lastChar = $request->input('lastChar', null);
        $finalPassword = 'default';

        # Set the different options for chars in the array
        $lettersCapitals = range('A', 'Z');
        $lettersLowers = range('a', 'z');
        $numbers = range('0', '9');
        $symbols = [ ')','!','@','#','$','%','^','&','*','(', ':',';','/','~','.' ];

        # Initialize the array of values
        $possibleValues=[];
        $finalPassword='';

        # For each checkbox, include more choices of values
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

        # Create password
        for ($i = 0; $i<$length; $i++) {
            if ($i==$length-1 and $lastChar!=null) {
                $finalPassword = $finalPassword.$lastChar;
            }
            else {
                $key = array_rand($possibleValues, 1);
                $finalPassword = $finalPassword.$possibleValues[$key];
            }
        }

        # Call the welcome layout with these variables
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
}
