<?php 

class XmlToCsv {
    
    public function parsing($xml_source) {
        $xml = new SimpleXMLElement($xml_source, null, true);
        $n = 0;
        
        foreach ($xml->channel->item as $item) {
            $link_str = (string)$item->link;
            foreach ($item->children('amzn', true)->products->children('amzn', true)->product as $amzn_product) {
//                 var_dump($amzn_product->children('amzn', true)->products->children('amzn', true)->product->children('amzn', true)->productURL);
//                 echo str_replace('https://amazon.com/dp/', '', $amzn_product->children('amzn', true)->productURL);
                   $url_temp = explode('/', $amzn_product->children('amzn', true)->productURL);
                   $asin = (string)$url_temp[4];
                   $url = (string)$amzn_product->children('amzn', true)->productURL;
                   $pr_name = (string)$amzn_product->children('amzn', true)->productHeadline;
                   $pr_summary = (string)$amzn_product->children('amzn', true)->productSummary;
                   $award = (string)$amzn_product->children('amzn', true)->award;
                   
                   $fields[$n]['asin'] = $asin;
                   $fields[$n]['url'] = $link_str;
                   $fields[$n]['amzn_url'] = $url;
                   $fields[$n]['pr_name'] = $pr_name;
                   $fields[$n]['pr_summary'] = $pr_summary;
                   $fields[$n]['pr_summary_count'] = mb_strlen($pr_summary);
                   $fields[$n]['award'] = $award;
                   $fields[$n]['award_count'] = mb_strlen($award);
                   $n++;
            }
            
        }
        
/*         
           echo '<pre>';
           var_dump($fields);
           echo '</pre>';
*/      
        return $fields;
        
    }
    
    function generate_csv($data, $output) {
        
        $date = date("Y-m-d");
        $path = $output . $_SERVER['SERVER_NAME'] . '_' . $date . '.csv';
        
        $csv = fopen($path, 'w');
        
        
        foreach ($data as $field) { 
            fputcsv($csv, $field, ';');
        }
        
        fclose($csv);
        
        return $csv;
    }
}


?>
