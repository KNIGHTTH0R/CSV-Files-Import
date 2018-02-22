<?php
class csv extends mysqli  
{
   private $state_csv = false;
   function __construct()
   {
        parent::__construct("localhost","root","likes","mcsv");
       if($this->connect_error)
        {
          echo "Fail to connect to Database : ".$this->connect_error;
        }
   }
   public function import($file)
   {
    $this->state_csv = false;
    $file = fopen($file, 'r');


    while($row = fgetcsv($file))
    {
    
    	
    	$value = "'". implode("','",$row) . "'";
    	$q = "INSERT INTO file(reading_time,altitude,temperature,pressure,humidity) VALUES(".$value .")";
    	if ($this->query($q))
    	{
          $this->state_csv = true;

    	}else
    	{
    		$this->state_csv = false;
    		echo $this->error;
    	}

    }
       if($this->state_csv)
       {
       	echo "Successfully Imported";
       }else
       {
       	echo"Something went wrong";
       }
   }
   public function export()
   {
   	$this->state_csv = false;
   	$q= "SELECT * FROM file";
   	$run = $this->query($q);
   	if($run->num_rows > 0)
   	{
       $fn ="csv_";
       $file = fopen("data/".$fn,"w");
       while ($row = $run->fetch_array(MYSQLI_NUM))
       {
        if (fputcsv($file,$row))
        {
        	$this->state_csv = true;
        }else
        {
        	$this->state_csv = false;
        }
    }
    if ($this->state_csv)
    	{
    		echo "Succesfully Export";
    	}else
    	{
    	echo "Something Went wrong";
    	}
       fclose($file);
   	}else
   	{
   		echo "No data found";
   	}
   }
}

?>