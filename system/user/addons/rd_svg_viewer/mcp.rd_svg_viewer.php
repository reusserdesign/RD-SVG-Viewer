<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rd_svg_viewer_mcp {
	
	public function __construct()
	{
		$this->include_styles();
	}

	public function index()
	{
		$return = '';

		if (version_compare(APP_VER, '3', '>='))
		{
			ee()->view->header = array( 'title' => lang('rd_svg_viewer_module_name') );
			
			$dir			= $_SERVER["DOCUMENT_ROOT"] . "/system/user/templates/default_site/_partials/";
			$files			= scandir($dir);
	
			$t_partials		= array();
			if (count($files) > 0)
			{
				foreach ($files as $file)
				{
					if(is_dir($file)) continue;
					
					// Check if file contents start with '<svg' and end with '/svg>'
					$contents = file_get_contents($dir.$file);
					if(stripos($contents, "<svg") === 0 && stripos($contents, "</svg>") !== false) {
						$t_partials[] = array(
							'partial_name' => $file
						);
					}
				}
			}

			$return = "<div class='svg_container'>";
			foreach ($t_partials as $t_partial)
			{
				$return .= "<div class='svg_contain'>";
				$return .= file_get_contents($_SERVER["DOCUMENT_ROOT"]."/system/user/templates/default_site/_partials/".$t_partial['partial_name']);
				$return .= "<span>".stristr($t_partial['partial_name'], ".html", true)."</span>";
				$return .= "</div>";
			}
			$return .= "</div>";
		}

		return $return;
	}
	
	protected function include_styles()
	{
		//add the css to the header
		ee()->cp->add_to_head('<style>.svg_container{display:-webkit-box;display:-moz-box;display:-ms-flexbox;display:-webkit-flex;display:flex;-webkit-flex-wrap:wrap;-moz-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;}.svg_contain{flex:1 1 auto;margin:.375rem;padding:.75rem;border:1px solid #000}.svg_contain>svg{display:block;width:4rem;height:4rem;margin:0 auto}.svg_contain>svg g,.svg_contain>svg path{fill:#000;}.svg_contain>span{display:block;margin-top:1rem;color:#000;text-align:center}</style>');
	}
	
}
// END CLASS

/* End of file mcp.rd_svg_viewer.php */
/* Location: ./system/user/addons/rd_svg_viewer/mcp.rd_svg_viewer.php */