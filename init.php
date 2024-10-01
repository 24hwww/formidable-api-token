<?php
if(!class_exists('MyActionClassName')){
class MyActionClassName extends FrmFormAction {
	
		public $name_class;
		public $name_action;
		public $title_action;

		function __construct() {
			
			$this->name_class = get_class($this);
			$this->name_action = "my_action_name";
			$this->title_action = "API integration";
			
			$action_ops = array(
				'classes'   => 'dashicons dashicons-rest-api',
				'limit'     => 99,
				'active'    => true,
				'priority'  => 50,
				'event'  => array( 'create', 'update' ),
			);

			$this->FrmFormAction($this->name_action, __($this->title_action, 'formidable'), $action_ops);
		}
	
		function init(){
			add_action('frm_registered_form_actions', array($this,'register_my_action_func'));
		}

		public function register_my_action_func( $actions ) {
			$actions[$this->name_action] = $this->name_class;
			return $actions;
		}
		/**
		* Get the HTML for your action settings
		*/
		function form( $form_action, $args = array() ) {
			extract($args);
			$action_control = $this;
	?>
			<table class="form-table frm-no-margin">
			<tbody>
			<tr>
				<th>
					<label>Template name</label>
				</th>
				<td>
					<input type="text" class="large-text" value="<?php echo esc_attr($form_action->post_content['template_name']); ?>" name="<?php echo $action_control->get_field_name('template_name') ?>">
				</td>
			</tr>
			<tr>
				<th>
					<label>Content></label>
				</th>
				<td>
					<textarea class="large-text" rows="5" cols="50" name="<?php echo $action_control->get_field_name('my_content') ?>"><?php echo esc_attr($form_action->post_content['my_content']); ?></textarea>
				</td>
			</tr>
			</tbody>
			</table>

			// If you have scripts to include, you can include them here
	<?php
		}

		/**
		* Add the default values for your options here
		*/
		function get_defaults() {
			return array(
				'template_name' => '',
				'my_content'=> '',
			);
		}
	}
	$tools = new MyActionClassName();
	$tools->init();
}
