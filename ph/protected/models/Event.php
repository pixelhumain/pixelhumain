<?php
/*
- system notifications are saved in the notification collection
- citizen Notifications are saved in the citizen collection under the notification node
 */
class Event
{

  /*public $microformat = '{
                        "@context": "http://schema.org",
                        "@type": "Event",
                        "name": "Miami Heat at Philadelphia 76ers - Game 3 (Home Game 1)",
                        "location": {
                          "@type": "Place",
                          "address": {
                            "@type": "PostalAddress",
                            "addressLocality": "Philadelphia",
                            "addressRegion": "PA"
                          },
                          "url": "wells-fargo-center.html"
                        },
                        "offers": {
                          "@type": "AggregateOffer",
                          "lowPrice": "$35",
                          "offerCount": "1938"
                        },
                        "startDate": "2016-04-21T20:00",
                        "url": "nba-miami-philidelphia-game3.html"
                      }';*/
const COLLECTION = "events";
public $microformat = '{
                        "toto":"dede"
                      }';
  public $jsonSchema = '{
                      "title": "Example Schema",
                      "type": "object",
                      "properties": {
                        "firstName": {
                          "type": "string",
                          "required":true
                        },
                        "lastName": {
                          "type": "string"
                        },
                        "age": {
                          "description": "Age in years",
                          "type": "integer",
                          "minimum": 0
                        }
                      }
                    }';

 
  /*function validate($key){
    var_dump($key);
    $jsonSchema = PHDB::findOne( PHType::TYPE_MICROFORMATS , array("key"=>$key) );
    var_dump(json_decode (json_encode ($jsonSchema["jsonSchema"]), FALSE));
    //var_dump(json_decode($this->jsonSchema));
    var_dump(json_decode($this->microformat));
    $validator = new Json\Validator( json_decode (json_encode ($jsonSchema["jsonSchema"]), FALSE) );
    $res = false;
    try{
      $validator->validate( json_decode($this->microformat) );
      $res = true;
    } catch(Exception $e){
      echo $e->getMessage();
    }
    echo $res;
      
  }*:
}