<?php

include dirname(__FILE__).'/db.php';

/**
 * Import VOR and NDBs into our database
 */
function get_coordinates($line) {
        /* Get the lat/long */
        preg_match('/^([A-Za-z])(\d*):(\d*:\d*)/', $line, $coords);

        $lat_dir = $coords[1];
        $lat_deg = $coords[2];
        $lat_min = $coords[3];

        $lat_deg = ($lat_deg*1.0) + ($lat_min/60.0);

        if(strtolower($lat_dir) == 's')
                $lat_deg = '-'.$lat_deg;

        if(strtolower($lat_dir) == 'w')
                $lat_deg = $lat_deg*-1;

        return $lat_deg;
}


/**
 * Return string with general location:
 * NAM - North America
 * SAM - South American
 * EUR - Europe
 * ASA - Asia
 * AFR - Africa
 * AUS - Australia
 * NAT - North Atlantic Track
 * SAT - South Atlantic Track
 * PAT - Pacific Ocean Track
 */
function get_earth_location($lat, $lng) {
        
        // Asia
        if($lng > 34 && $lng < 180) {
                // Australia
                if($lat < -11) {
                        return 'AUS';
                }
                
                return 'ASA';
        }
        
        
        // NAT
        if($lng > -58 && $lng < -11) {
                if($lat > 42) {
                        return 'NAT';
                }
        }
        
        // Europe
        if($lng > -15 && $lng < 40) {
                if($lat > 35) {
                        return 'EUR';
                }
        }
        
        // NAM
        if($lng > -180 && $lng < - 56){
                if($lat > 25) {
                        return 'NAM';
                } else {
                        return 'SAM';
                }
        }
        
        return '';
}

# Setup the inserts into chunks of 1000
$chunks = 3000;

// Load intersections
echo "Loading INTs...";



$total = 0;
$updated = 0;
$chunks = 3000;
$updated_list = array();

$list2 = array();


$sql = "INSERT INTO phpvms_navdata (name, title, loc, lat, lng, type) VALUES ";

$handle = fopen("fsbuild/ints.txt", "r");
while ($lineinfo2 = fscanf($handle, "%s %s %s %s %s\n"))  {
        if($lineinfo2[0][0] == ';') {
                continue;
        }
        
        list ($name, $title, $lat, $lng, $type) = $lineinfo2;

                
	    $title = mysql_escape_string($title);
      
        $type = NAV_FIX;
        
        $res = mysql_query("SELECT id FROM phpvms_navdata WHERE `name`='{$name}'");
        if(mysql_num_rows($res) > 0) {

                
              
                $updated ++;
                continue;
        } else { 
                //echo "adding {$name}\n";
                $loc = get_earth_location($lat, $lng);
			
                $list2[] = "('{$name}', '{$title}', '{$loc}', '{$lat}', '{$lng}', '{$type}')";
        }
        
        if($total == $chunks) {
                $values = implode(',', $list2);
                $list2 = array();

                mysqli_query($connection, $sql.$values);

                if(mysql_errno() != 0) {
                        echo "============\n".mysql_error()."\n==========\n";
                        die();
                }

                $chunks += $chunks;
        }
        
        $total ++;
}

$values = implode(',', $list2);
mysql_query($sql.$values);

fclose($handle);

echo "{$total} INTs added, {$updated} bypassed already in DB\n";

echo "Completed!\n";
