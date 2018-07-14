<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cicaptcha 
{

	public function __construct() 
	{
	  $this->ci =& get_instance();
	  $this->ci->load->helper('captcha');
	}  


	public function show()
	{
				$vals = array(
				        'img_path'      => FCPATH . 'assets/captcha/',
				        'img_url'       => base_url('assets/captcha') . '/',
				        'font_path'     => FCPATH . 'assets/fonts/SpicyRice.ttf',
				        'img_width'     => 140,
				        'img_height'    => 35,
				        'expiration'    => 3600,
				        'word_length'   => 4,
				        'font_size'     => 15,
				        'img_id'        => 'Imageid',
				        'pool'          => '12356789',

				        // White background and border, black text and red grid
				        'colors'        => array(
		                'background' 	=> array(255, 255, 255),
		                'border' 		=> array(255, 255, 255),
		                'text' 			=> array(0, 0, 255),
		                'grid' 			=> array(255, 200, 255)
				        )
				);
		$cap = create_captcha($vals);

		$data = array(
		    'captcha_time'	=> $cap['time'],
		    'ip_address'	=> $this->ci->input->ip_address(),
		    'word'	=> $cap['word']
		    );
		$query = $this->ci->db->insert_string('captcha', $data);
		$this->ci->db->query($query);

		return '
		  <div class="input-group input-group-lg">
		    <input name="cicaptcha" type="text" class="form-control" placeholder="الرقم التأكيدى" style="font-size: 14px;">
		    <span class="input-group-addon">'.$cap['image'].'</span>
		  </div>    ';
	}


	public function validate()
	{
		// First, delete old captchas
		$expiration = time()-7200; // Two hour limit
		$this->ci->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);

		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($_POST['cicaptcha'], $this->ci->input->ip_address(), $expiration);
		$query = $this->ci->db->query($sql, $binds);
		$row = $query->row();

		if ($row->count == 0)
		{
		  return false;
		}else{
		  return true;
		}

	}

}