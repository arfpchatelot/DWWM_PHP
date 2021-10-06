

<?php

class FormValidation
{
    private $tabform = array();


    public function __construct(array $_tab)

    {
        $this->tabform = $_tab;
    }

    public function isFilled()
    {
        $fill = true;
        foreach ($this->tabform as $key => $val) {
            if (empty($_POST[$key])) {
                $fill = false;

                return $fill;
            }
        }

        return $fill;
    }

    public function isValid()
    {
     
    $valid=true;
        foreach ($this->tabform as $key => $val) 
        {

            echo "type :" . gettype($_POST[$key]) . "<br/>";
            
        
                if( $val=='integer')
                {
                    $test= settype($_POST[$key], "integer");

                    if( $_POST[$key]==0)  
                    
                        $valid = false;
                        

                 }

              if( $val=='double')
                {
                    $test= settype($_POST[$key], "float");

                    if( $_POST[$key]==0)  
                    
                        $valid = false;
                        

                 }
               
             
                      
            

        }
        return $valid;
        
    }
}


?>
