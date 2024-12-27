<?php
if (!class_exists('Sala_Base_Widget')) {
	class Sala_Base_Widget {

		public function __construct(){
			add_action('widgets_init', array($this,'register_widget'), 1);
			$this->includes();
			spl_autoload_register(array($this,'autoload'));
		}

		public function autoload($class_name) {
			$class = preg_replace('/^Sala_Widget_/', '', $class_name);
			if ($class != $class_name) {
				$class = str_replace('_', '-', $class);
				$class = strtolower($class);
				include_once( SALA_THEME_DIR . 'inc/widgets/includes/' . $class .'.php');
			}
		}

		private function includes(){
			include_once( SALA_THEME_DIR . 'inc/widgets/widget-config.php' );
		}

		public function register_widget(){
			register_widget('Sala_Widget_Popular_Posts');
		}
	}

	new Sala_Base_Widget();
}
