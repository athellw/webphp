	<?php


	$summoner =$_POST['username'];
	$server =  $_POST['nation'];

	$refined_name = RefineSummonerName($summoner);
	$summoner_info_array = Summoner_name_to_idInfo($refined_name,$server);

	$summoner_id = Summoner_id_return($summoner_info_array);

	$match_list_array = match_list($summoner_id,$server);

	$champion = champion_data(67);

	// echo json_encode($match_list_array[0]);

		echo json_encode($champion['image']);







	function Summoner_name_to_idInfo($summoner,$server){
	    
	    $summoner_encoded = rawurlencode($summoner);
	    $summoner_lower =  strtolower($summoner_encoded);
	    
	    
	    $curl = curl_init('https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v1.4/summoner/by-name/'.$summoner.'?api_key=68023d09-7048-4d6f-acc7-2ae2121f2590');


	    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	    $result = curl_exec($curl);

		$decoded_summoner_info = json_decode($result,true);
	    $final_summoner_info= $decoded_summoner_info[$summoner];

		return $final_summoner_info;


	}


	function Summoner_id_return($data){


		$summoner_id = $data['id'];

		return $summoner_id;

	}


	function match_list($rawId,$server){

		$id = (string)$rawId;

		$curl = curl_init('https://'.$server.'.api.pvp.net/api/lol/'.$server.'/v2.2/matchlist/by-summoner/'.$id.'?api_key=68023d09-7048-4d6f-acc7-2ae2121f2590');

		// $curl = curl_init('https://kr.api.pvp.net/api/lol/kr/v2.2/matchlist/by-summoner/2427390?api_key=68023d09-7048-4d6f-acc7-2ae2121f2590');

		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		
		$result = curl_exec($curl);

		$decoded_match_list = json_decode($result,true);


		return $decoded_match_list['matches'];



		}


		function champion_data($championId){



			$curl = curl_init('https://global.api.pvp.net/api/lol/static-data/kr/v1.2/champion/'.$championId.'?champData=image&api_key=68023d09-7048-4d6f-acc7-2ae2121f2590');

			curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

			$result = curl_exec($curl);

			$champion_data_array = json_decode($result,true);


			return $champion_data_array;



		}


	function RefineSummonerName($summoner) {
			    
			$summoner_lower = mb_strtolower($summoner, 'UTF-8');
			$summoner_nospaces = str_replace(' ', '', $summoner_lower);
			return $summoner_nospaces;

			}
	?>
