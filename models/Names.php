<?php

class NameFactory 
{
    private static $last_names = array("Marylin","Cherie","Lorie","Vincenzo","Carter","Margit","Shavonda","Kristofer","Keena","Bill","Laura","Gearldine","Selene","Ngoc","Kam","Dwana","Becky","Dot","Jaimie","Amos","Claris","Bernard","Leona","Alphonse","Gertha","Heidy","Lura","Tiffaney","Krystin","Regan","Kendrick","Sharmaine","Kristeen","Adrienne","Laronda","Stanley","Hope","Dedra","Carolina","Myles","Lorinda","Taren","Salvador","Lori","Harriet","Robyn","Karlene","Marchelle","Denis","Shantae");

  public static function getRandomName() {
    return self::$last_names[array_rand(self::$last_names)];
  }
}