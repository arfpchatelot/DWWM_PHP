<?php 


class ComptablePublic 
{
    //attributs
   private $nom ="";
   private $revenu=0;
  
   public Const taux1=0.09;
   public Const taux2=0.14;

   //constructeur  
   public function __construct( string $_nom, float $_revenu)
   {
       $this->nom=$_nom;
       $this->revenu=$_revenu;

   }

   //propriétés 
    public function getRevenu()
    { 
        return $this->revenu;
    } 

     public function getNom()
    { 
        return $this->nom;
    }
    
    //methodes
    public function calculImpot() 
    {   
        $impot=0;
        if ($this->revenu<=15000 ) {

           $impot=$this->revenu *self::taux1 ;
        } 
        else 
        { 
            $impot= 15000* self::taux1 +($this->revenu-15000)*self::taux2;
            
        }
        return $impot;
    }


}

?>