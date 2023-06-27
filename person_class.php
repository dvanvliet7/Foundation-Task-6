<?php
    include('item_generator.php');

    /*
    Create a class in your php script called "Person" that will have 6 functions:
    - createPerson
    - loadPerson
    - savePerson
    - deletePerson
    - loadAllPeople
    - deleteAllPeople 
    */

    class Person {
        // public $NamesArr;
        // public $SurNamesArr;
        // public $DatesArr;
        // public $EmailAddressArr;
        // public $AgeArr;

        public string $FirstNameStr;
        public string $SurNameStr;
        public string $DateOfBirthStr;
        public string $EmailAddressStr;
        public int $AgeInt;

        private $ConnectionObj;

        function createPerson($FirstNameStr, $SurNameStr, $DateOfBirthStr, $EmailAddressStr, $AgeInt) { // Attributes of person
            $this->FirstNameStr = $FirstNameStr; //error
            $this->SurNameStr = $SurNameStr;
            $this->DateOfBirthStr = $DateOfBirthStr;
            $this->EmailAddressStr = $EmailAddressStr;
            $this->AgeInt = $AgeInt;
        }


        function checkQuery($Query) { // checking Query succesful
            if ($this->ConnectionObj->query($Query) === TRUE) {
                echo "Success<br>";
              } else {
                echo "Error: " . "<br>" . $this->ConnectionObj->error;
              }
        }


        function createConn() { // creating Connection
            $this->ConnectionObj = new mysqli("localhost", "root", "", "foundation_task_6");
            if ($this->ConnectionObj->connect_error) {
                die("Connection failed: " . $this->ConnectionObj->connect_error);
            }
        }


        function endConn() { // ending Connection
            $this->ConnectionObj->close();
        }


        function calcAge($Bday) { //calculating the age of a user when date of birth is given
            $BirthDay = new DateTime($Bday);
            $today = new DateTime(date('y-m-d'));
            $diff = $today->diff($BirthDay);
           
            return $diff->y;
        }


        function loadPerson() { // loading a person object in the database
            $this->createConn();

            // insert
            $InsertToSQL = "INSERT INTO person (FirstName, LastName, DateOfBirth, EmailAddress, Age)
                    VALUES ('$this->FirstNameStr', '$this->SurNameStr', '$this->DateOfBirthStr', '$this->EmailAddressStr', $this->AgeInt)";
            $this->ConnectionObj->query($InsertToSQL);

            $this->endConn();
        }


        function savePerson($InputID) { // editing & saving a person to the database (done in the edit_person.html)
            $this->createConn();
            
            // Update item
            $Query = "UPDATE person
            SET FirstName = '$this->FirstNameStr',
            LastName = '$this->SurNameStr',
            DateOfBirth = '$this->DateOfBirthStr',
            EmailAddress = '$this->EmailAddressStr',
            Age = '$this->AgeInt'
            WHERE ID = $InputID" ;
            $this->ConnectionObj->query($Query);

            $this->endConn();
        }


        function deletePerson($RowIDInt) { //delete an entry of the database (done in the home_page.html)
            $this->createConn();

            // Delete
            $DeleteOneRow = "DELETE FROM person WHERE ID = $RowIDInt";
            $this->ConnectionObj->query($DeleteOneRow);

            $this->endConn();
        }


        function generatePeople() { //Generate 10 people and load in database
            #
        }


        function loadAllPeople() { // load all objects to js file to then display database entries in home_page.html
           $this->createConn();

            // read all items from database table
            $Query = "SELECT * FROM person";
            $ResultObj = $this->ConnectionObj->query($Query);
            if (!$ResultObj) {
                die("Invalid query: " . $this->ConnectionObj->error);
            }

            // create an array for js file
            $ObjectArr = array();

            // Read data of each row
            while($RowObj = $ResultObj->fetch_assoc()) {
                $PersonObj = new Person();
                $PersonObj->createPerson($RowObj["FirstName"], $RowObj["LastName"], $RowObj["DateOfBirth"], $RowObj["EmailAddress"], $RowObj["Age"]);

                array_push($ObjectArr, $PersonObj);
            }

            // end connection
            $this->endConn();
            
            // return array
            return $ObjectArr;
        }


        function deleteAllPeople() { // delete ALL entries in the database
            $this->createConn();

            // Delete everything
            $DeleteAllElements = "TRUNCATE TABLE person";
            $this->ConnectionObj->query($DeleteAllElements);

            $this->endConn();
        }
    }

    // Testing...

    // $NewPerson = new Person();
    // $Object = $NewPerson->loadAllPeople();
    // print_r($Object) ;
    // echo "<br>" . "<br>";
    // var_dump($Object);
    // echo "<br>", "<br>";
    // echo json_encode($Object);
    // echo "<br>", "<br>";
    // var_dump(json_encode($Object)) ;
?>