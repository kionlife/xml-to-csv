<?php 

class XmlToCsv {
    
    public function parsing($xml_source) {
    
        /* Write headers to array */
        
        $fields[0]['asin'] = 'ASIN';
        $fields[0]['url'] = 'URL';
        $fields[0]['amzn_url'] = 'Amazon Url';
        $fields[0]['pr_name'] = 'Product Name';
        $fields[0]['pr_summary'] = 'Amazon Product Summary';
        $fields[0]['pr_summary_count'] = 'Amazon Product Summary COUNT';
        $fields[0]['award'] = 'Amazon Award';
        $fields[0]['award_count'] = 'Amazon Award COUNT';
    
        $xml = new SimpleXMLElement($xml_source, null, true);
        $n = 1;
        
        foreach ($xml->channel->item as $item) {
            $link_str = (string)$item->link;
            foreach ($item->children('amzn', true)->products->children('amzn', true)->product as $amzn_product) {
                   $url_temp = explode('/', $amzn_product->children('amzn', true)->productURL);
                   $asin = (string)$url_temp[4];
                   $url = (string)$amzn_product->children('amzn', true)->productURL;
                   $pr_name = (string)$amzn_product->children('amzn', true)->productHeadline;
                   $pr_summary = (string)$amzn_product->children('amzn', true)->productSummary;
                   $award = (string)$amzn_product->children('amzn', true)->award;
                   
                   /* Write data to array */
                   
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
            
        return $fields;
        
    }
    
    function generate_csv($data, $output) {
        
        $date = date("Y-m-d");
        $path = $output . $_SERVER['SERVER_NAME'] . '_' . $date . '.csv';     //Name generate
        
        $csv = fopen($path, 'w');
        
        
        foreach ($data as $field) { 
            fputcsv($csv, $field, ';');                     //Put to csv file
        }
        
        fclose($csv);
        
        return $csv;
    }
}


?>
