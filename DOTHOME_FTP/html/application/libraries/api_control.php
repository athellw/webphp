<?php 

class Api_Control {
	

	public function Summoner_name_to_idInfo($summoner,$server){


	    
	    $summoner_encoded = rawurlencode($summoner);
	    $summoner_lower =  strtolower($summoner_encoded);
	    
	    
	    $curl = curl_init('https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.4/summoner/by-name/'.$summoner.'?api_key=9a0e73e5-fd34-465e-a4d6-6128d96fd902');


	    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	    $result = curl_exec($curl);

		$decoded_summoner_info = json_decode($result,true);

		
		if(array_key_exists('status', $decoded_summoner_info)){
					
			return $final_summoner_info= null;
						
		}
		else{
	      	
	      	$final_summoner_info= $decoded_summoner_info[$summoner];
		}
		
		return $final_summoner_info;


	}


	public function Summoner_id_return($data){


		$summoner_id = $data['id'];

		return $summoner_id;

	}


	public function match_list($rawId,$server){

		$id = (string)$rawId;

		$curl = curl_init('https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v2.2/matchlist/by-summoner/'.$id.'?api_key=9a0e73e5-fd34-465e-a4d6-6128d96fd902');

		// $curl = curl_init('https://kr.api.pvp.net/api/lol/kr/v2.2/matchlist/by-summoner/2427390?api_key=68023d09-7048-4d6f-acc7-2ae2121f2590');

		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		
		$result = curl_exec($curl);

		$decoded_match_list = json_decode($result,true);


		return $decoded_match_list;



		}


	public function champion_data($championId){



			$curl = curl_init('https://global.api.pvp.net/api/lol/static-data/kr/v1.2/champion/'.$championId.'?champData=image&api_key=9a0e73e5-fd34-465e-a4d6-6128d96fd902');

			curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

			$result = curl_exec($curl);

			$champion_data_array = json_decode($result,true);


			return $champion_data_array['matches'];



		}

			public function match($matchId){

			$id = (string)$matchId;


			$curl = curl_init('https://kr.api.pvp.net/api/lol/kr/v2.2/match/'.$id.'?api_key=9a0e73e5-fd34-465e-a4d6-6128d96fd902');

			curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

			$result = curl_exec($curl);

			$match_array = json_decode($result,true);

			return $match_array;



		}



	public function RefineSummonerName($summoner) {
			utf8_encode($summoner);
			$summoner_lower = mb_strtolower($summoner, 'UTF8');
			$summoner_nospaces = str_replace(' ', '', $summoner_lower);
			return $summoner_nospaces;

			}



} ?>