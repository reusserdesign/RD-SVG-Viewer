<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rd_svg_viewer_upd {

    var $version		= '3.0.2';
	var $module_name	= 'Rd_svg_viewer';
	
	function install()
	{
		$data = array(
			'module_name'			=> $this->module_name ,
			'module_version'		=> $this->version,
			'has_cp_backend'		=> 'y',
			'has_publish_fields'	=> 'n'
		);
		
		ee()->db->insert('modules', $data);
	}
	
	function update($current = '')
	{
		if (version_compare($current, '3.0.2', '>='))
		{
			return FALSE;
		}
	
		return TRUE;
	}
	
	function uninstall()
	{
		ee()->db->delete('modules', array('module_name' => $this->module_name));
		
		return TRUE;
	}
	
}
// END CLASS

/* End of file upd.rd_svg_viewer.php */
/* Location: ./system/user/addons/rd_svg_viewer/upd.rd_svg_viewer.php */