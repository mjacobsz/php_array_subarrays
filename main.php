<?php

  // Get all subarrays for an array A
  //
  // The algorithm is based on the following principle:
  // For every element e in A; it is either present or absent in a subarray.
  // This means that there are exacly 2^size_of(A) subarrays.
  //
  // We will therefore loop this number of times, and create a bitmap in every
  // iteration. This bitmap consists of the binary representation of the current
  // loop number. We will then use this bitmap as a mask on the original array to
  // determine which element to include in the current subarray.
  //
  // We can be sure that we have all subarrays, because we exacly loop the number
  // of times as there are subarrays. And these numbers are unique, and therefore
  // the bitmaps are unique as well.
  //
  // Example:
  // A = [3, 7] 
  // This means we have the following bitmaps "00", "01", "10" and "11"
  // We 'intersect' these bitmaps with the original array to get the subarrays:
  // [], [7], [3], [3,7]

  $a  = array(1, 3, "aap" => "noot", 33);
  $ak = array_keys($a);
  
  // Create an container array to store all subsets
  $subarrays = array();
  
  // Get all subsets in this loop
  $number_of_subsets = pow(2, count($a)); 
  for ($i = 0; $i < $number_of_subsets; $i++) {

    // New subarray
    $subarray = array();

    // Create the bitmap
    $n = strrev(decbin($i)); // Reverse the bitstring, so it matches array ordering
    $binary_map_of_elements_to_include = str_split($n);
    
    $length_of_binary_map = count($binary_map_of_elements_to_include);
    for ($j = 0; $j < $length_of_binary_map; $j++) {
    
      // Insert the element when we encounter a '1'
      if ($binary_map_of_elements_to_include[$j] == "1") {
        
        if(is_string($ak[$j])) {            // When the key is a string, we want to copy this key to the subarray
          $subarray[$ak[$j]] = $a[$ak[$j]];
        } else {
         $subarray[] = $a[$ak[$j]];         // When the key is a integer, just do the regular index numbering
        }
      
      }

    }
  
    // Add subarray to the list of results  
    $subarrays[] = $subarray;
  }

  print_r($subarrays);

?>
