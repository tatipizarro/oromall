<?php
    Class Sesiones{

        static function init(){
            session_start();            
        }

        static function unsetValues(){
            session_unset();      
        }
        
        static function destroy(){
            session_destroy();
        }  

        static function getValue($var){
            return $_SESSION[$var];
        }

        static function setValue($var, $val){           
            return $_SESSION[$var] = $val;
        }

        static function exist(){
            if(sizeof($_SESSION) > 0){
                return true;
            }else{
                return false;
            }                
        }
    }
 ?>             
