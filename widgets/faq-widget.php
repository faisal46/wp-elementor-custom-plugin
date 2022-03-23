<?php

class Elementor_Faq_Widget extends \Elementor\Widget_Base{
	public function get_name() {
		return 'FaqWidgets';
	}

	public function get_title() {
		return esc_html__( 'Faq Widgets', 'elementorcustomaddon' );
	}

	public function get_icon() {
		return 'eicon-document-file';
	}

	public function get_custom_help_url() {}

	public function get_categories() {
		return array( 'custom_basic_category' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'elementorcustomaddon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'elementorcustomaddon' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$repeater->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description', 'elementorcustomaddon' ),
				// 'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'faqs',
			[
				'label'       => esc_html__( 'FAQs', 'elementorcustomaddon' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'    => [
					[
						'title'   => 'Faq Title 1',
					    'description'   => 'Faq description 1',
					],
					
					[
						'title'   => 'Faq Title 2',
					    'description'   => 'Faq description 2',
					],
				],
			]
		);


		$this->end_controls_section();
	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$faqs = $settings['faqs'];
		// print_r($faqs);
		if( $faqs ) {
			foreach ( $faqs as $faq ) { 
				echo "<h3>".$faq['title']."</h3>";
				echo "<p>".$faq['description']."</p>";
			}
		}
		
	
	}

	protected function content_template() {
		?>
		<!-- Faq output. -->
		<div>
		<#
		if( settings.faqs.length ){
			_.each( settings.faqs, function( faq ) { #>
				<h3>{{{ faq.title }}}</h3>
                <p>{{{ faq.description }}}</p>
			<# } )
		} #>
            
			
			
		</div>

		<?php
	}
}