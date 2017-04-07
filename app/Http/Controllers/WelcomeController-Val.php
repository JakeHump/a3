<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;



class WelcomeController extends Controller
{

    public function __invoke(Request $request) {

          # Collect information about what was submitted as well as declare variables
          $length = $request->input('length', null);
          $lengthMin = 7;
          $lengthMax = 12;
          $includeCapitals = $request->has('includeCapitals', null);
          $includeLowers = $request->has('includeLowers', null);
          $includeNumbers = $request->has('includeNumbers', null);
          $includeSymbols = $request->has('includeSymbols', null);
          $lastChar = $request->input('lastChar', null);

          $finalPassword = '';

          # My own validation - see comments in submission
          # If length is set and between the min and max
          if (!empty($length) && $length >=$lengthMin && $length <=$lengthMax) {
              #dump($request->all());
              $finalPassword = $this->generatePassword($request);
          }
          else {
              $finalPassword = 'You must enter a valid length';
          }

          # Return values to the welcome HTML layout
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

    # Function for creating the password based on the user input
    public function generatePassword(Request $request) {

          $length = $request->input('length', null);
          $includeCapitals = $request->has('includeCapitals', null);
          $includeLowers = $request->has('includeLowers', null);
          $includeNumbers = $request->has('includeNumbers', null);
          $includeSymbols = $request->has('includeSymbols', null);
          $lastChar = $request->input('lastChar', null);
          $valCheckbox = false;

          # Set all of the potential values
          $lettersCapitals = range('A', 'Z');
          $lettersLowers = range('a', 'z');
          $numbers = range('0', '9');
          $symbols = [ ')','!','@','#','$','%','^','&','*','(', ':',';','/','~','.' ];

          # Initialize array for possible values and final password
          $possibleValues=[];
          $finalPassword='';

          if ($length != null ) {

              # for each checked box build the list
              if ($includeCapitals != null) {
                  $possibleValues = array_merge($possibleValues, $lettersCapitals);
                  $valCheckbox = true;
              }

              if ($includeLowers != null) {
                  $possibleValues = array_merge($possibleValues, $lettersLowers);
                  $valCheckbox = true;
              }

              if ($includeNumbers != null) {
                  $possibleValues = array_merge($possibleValues, $numbers);
                  $valCheckbox = true;
              }

              if ($includeSymbols != null) {
                  $possibleValues = array_merge($possibleValues, $symbols);
                  $valCheckbox = true;
              }

              # If at least one of the checkboxes is checked, build the password
              if ($valCheckbox == true) {

                  for ($i = 0; $i<$length; $i++) {
                      if ($i==$length-1 and $lastChar!=null) {
                          $finalPassword = $finalPassword.$lastChar;
                      }
                      else {
                          $key=array_rand($possibleValues, 1);
                          $finalPassword = $finalPassword.$possibleValues[$key];
                      }
                  }
              }

              # Let the user know they need to check at least one box
              else {
                  $finalPassword='You must check at least one checkbox';
              }

         }

         # Let the user know the lenght is out of bounds
         else {
             $finalPassword='You must enter a valid length';
         }

         return $finalPassword;
     }
}
