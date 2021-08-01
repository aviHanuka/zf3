<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Portal\WordsController;

use Zend\Mvc\Controller\AbstractActionController;

class WordsController extends AbstractActionController {
	private static $instance = null;
	private $cookie_name;
	public $session;

	public function __construct( $name = null ) {
		$this->cookie_name = 'temps';
	}

	/**
	 * @return WordsController|null
	 */
	public static function getInstance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __clone() {
		// TODO: Implement __clone() method.
	}

	public function __invoke( $container, $requestedName, array $options = null ) {
	}

	/**
	 * @param $text
	 *
	 * @return array|string
	 */
	public function manipulate_word( $text ) {
		$response = [];
		$str = $this->validate_text( $text );
		if ( $str ) {
			$str = preg_replace('/[\s-]+/', '-', $str);
			$str = str_replace( '-', '', $str );
			if ( !empty( $str ) ) {
				$arr = explode( " ", $str );
				foreach ( $arr as $k=>$v ) {
					if ( strpos( $this->demmy_string(), $v ) === false ) {
						continue;
					}
					array_push( $response, $v );
				}

				return $response;
			}
		}

		return 'error';
	}

	protected function validate_text( $text = '' ) {
		if ( ! empty( $text ) ) {
			$text = htmlentities( trim( $text ) );
			if ( $text ) {
				return $text;
			}
		}

		return false;
	}

	public function demmy_string() {
		return 'square kilometers), it is the worlds third- or fourth-largest country by total area.[c] The United States shares significant land borders with Canada to the north and Mexico to the south, as well as limited maritime borders with Cuba, Russia, and the Bahamas.[22] With a population of more than 331 million people, it is the third most populous country in the world. The national capital is Washington, D.C., and the most populous city is New York City.
		Paleo-Indians migrated from Siberia to the North American mainland at least 12,000 years ago, and European colonization began in the 16th century. The United States emerged from the thirteen British colonies established along the East Coast. Disputes over taxation and political representation with Great Britain led to the American Revolutionary War (1775–1783), which established independence. In the late 18th century, the U.S. began expanding across North America, gradually obtaining new territories, sometimes through war, frequently displacing Native Americans, and admitting new states; by 1848, the United States spanned the continent. Slavery was legal in the southern United States until the second half of the 19th century when the American Civil War led to its abolition. The Spanish–American War and World War I established the U.S. as a world power, a status confirmed by the outcome of World War II.
		During the Cold War, the United States fought the Korean War and the Vietnam War but avoided direct military conflict with the Soviet Union. The two superpowers competed in the Space Race, culminating in the 1969 spaceflight that first landed humans on the Moon. The Soviet Unions dissolution in 1991 ended the Cold War, leaving the United States as the worlds sole superpower.
		The United States is a federal republic and a representative democracy with three separate branches of government, including a bicameral legislature. It is a founding member of the United Nations, World Bank, International Monetary Fund, Organization of American States, NATO, and other international organizations. It is a permanent member of the United Nations Security Council. Considered a melting pot of cultures and ethnicities, its population has been profoundly shaped by centuries of immigration. The U.S. ranks high in international measures of economic freedom, quality of life, education, and human rights, and has low levels of perceived corruption. However, the country has received criticism concerning inequality related to race, wealth and income, the use of capital punishment, high incarceration rates, and lack of universal health care.
		The United States is a highly developed country, accounts for approximately a quarter of global GDP, and is the worlds largest economy by GDP at market exchange rates. By value, the United States is the worlds largest importer and the second-largest exporter of goods. Although its population is only 4.2% of the worlds total, it holds 29.4% of the total wealth in the world, the largest share held by any country. Making up more than a third of global military spending, it is the foremost military power in the world; and it is an unrivaled political, cultural, and scientific force internationally';
	}

}

$self = WordsController::getInstance();
$self->manipulate_word( 'hello word' );

