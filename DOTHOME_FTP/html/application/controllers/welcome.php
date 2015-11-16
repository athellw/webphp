 <?php 	

if ( ! defined('BASEPATH')) exit('No direct script access allowed');	



class Welcome extends CI_Controller {


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name> 
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('header');
		$this->load->view('sidebar');


		$this->load->view('main_content');
		$this->load->view('footer');



	}

	public function get($summonerName){



			$this->output->set_header("Content-Type: text/html; charset=UTF-8;");
			$summoner_name = rawurldecode($summonerName);

	
			$this->load->library('api_control');	

			$refined_name = $this->api_control->RefineSummonerName($summoner_name); 
			
			if(!is_null($refined_name)){				

			$summoner_info_array =  $this->api_control->Summoner_name_to_idInfo($refined_name,'kr');
			$summoner_id =  $this->api_control->Summoner_id_return($summoner_info_array);
			$match_list_array =  $this->api_control->match_list($summoner_id,'kr');
			$match_list_ids=array(); 

			}

			if(array_key_exists('matches', $match_list_array)) {		
				for($i=0;$i<10;$i++){

					$match_list_ids[] = $match_list_array['matches'][$i]['matchId'];
									


				} // match list 에서 최근 10개임의 matchid만을 담은 배열을 만듦. 나중에 api_control에 편입예정. 
  				$match_array = 	$this->api_control->match($match_list_ids[0]); // 가장 최근 게임의 match정보를 다 받아옴. 

				for($i=0;$i<10;$i++){

					$player_names[] = $match_array['participantIdentities'][$i]['player']['summonerName']; //받아온 match정보들 중에서 player이름만 배열에 10개를 담음 이것도 나중에 api_control에 편입 
					$champion_ids[] =  $match_array['participants'][$i]['championId'];

				}

				for($i=0;$i<10;$i++){

					$champion_image[] = $this->api_control->ImageReturn($champion_ids[$i]); 
				}

			}
			else{
				
				$player_names = array();
				$player_names[] = 'try it after 10secs.';

			}
				
		



			$data = array("players"=>$player_names,"champions"=>$champion_ids,"Images"=>$champion_image);
			$summoner_name = array("summoner_name"=>$summoner_name);

			$this->load->view('header');
			$this->load->view('sidebar_get',$summoner_name);


			$this->load->view('main_content_get',$data);
			$this->load->view('footer');
			}


	}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */