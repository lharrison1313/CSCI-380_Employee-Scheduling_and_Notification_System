<?php
class User{
    private $conn;
    private $table_name = "Users";

    public $Username;
    public $Name;
    public $Email;
    public $Password;
    public $StartDate;
    public $EmployeeID;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        //creating querry
        $querry = "SELECT Username, Name, StartDate, EmployeeID 
        FROM " . $this->table_name . "";

        //preparing querry
        $stmt = $this->conn->prepare($querry);

        //executing querry
        $stmt->execute();
        return $stmt;

    }

    function create(){
        //creating insert querry
        $querry = "INSERT INTO " . $this->table_name . "
        SET Username=:Username, Name=:Name, Email=:Email, Password=:Password, 
        StartDate=:StartDate, EmployeeID=:EmployeeID";

        //preparing querry
        $stmt = $this->conn->prepar($querry);

        //cleaning data
        $this->Username = htmlspecialchars(strip_tags($this->Username));
        $this->Name = htmlspecialchars(strip_tags($this->Name));
        $this->Email = htmlspecialchars(strip_tags($this->Email));
        $this->Password = htmlspecialchars(strip_tags($this->Password));
        $this->EmployeeID = htmlspecialchars(strip_tags($this->EmployeeID));

        //hashing password
        $this->Password = password_hash($this->Password,PASSWORD_DEFAULT);

        //binding data to querry
        $stmt->bindParam(":Username",$this->Username);
        $stmt->bindParam(":Name",$this->name);
        $stmt->bindParam(":Email",$this->Email);
        $stmt->bindParam(":Password",$this->Password);
        $stmt->bindParam(":EmployeeID",$this->EmployeeID);
        $stmt->bindParam(":StartDate",$this->StartDate);

        if($stmt->execute()){
            return true;
        }
        
        return false;

    }
    
}
?>
