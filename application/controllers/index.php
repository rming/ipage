<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class index extends MY_Controller {

	public function __construct(){
		parent::__construct(false);
	}

	public function index(){
		$poetry = array(
			'If you shed tears when you miss the sun, you also miss the stars.',
			'Once we dreamt that we were strangers. We wake up to find that we were dear to each other. ',
			'My heart, the bird of the wilderness, has found its sky in your eyes. ',
			'It is the tears of the earth that keep her smiles in bloom. ',
			'If you shed tears when you miss the sun, you also miss the stars.',
			'What you are you do not see, what you see is your shadow. ',
			'The waterfall sing, "I find my song, when I find my freedom." ',
			'You smiled and talked to me of nothing and I felt that for this I had been waiting long. ',
			'Man does not reveal himself in his history, he struggles up through it. ',
			'Like the meeting of the seagulls and the waves we meet and come near.The seagulls fly off, the waves roll away and we depart. ',
			'We come nearest to the great when we are great in humility. ',
			'Never be afraid of the moments--thus sings the voice of the everlasting. ',
			'The perfect decks itself in beauty for the love of the Imperfect. ',
			'Wrong cannot afford defeat but right can. ',
			'In my solitude of heart I feel the sigh of this widowed evening veiled with mist and rain. ',
			'We read the world wrong and say that it deceives us. ',
			'Man barricades against himself. ',
			'Let life be beautiful like summer flowers and death like autumn leaves. ',
			'I think of other ages that floated upon the stream of life and love and death and are forgotten, and I feel the freedom of passing away. ',
			'Do not linger to gather flowers to keep them, but walk on,for flowers will keep themselves blooming all your way. ',
			'Thoughts pass in my mind like flocks of ducks in the sky.I hear the voice of their wings. ',
			'Who drives me forward like fate？The Myself striding on my back. ',
			'Our desire lends the colours of the rainbow to the mere mists and vapours of life. ',
			'Stray birds of summer come to my window to sing and fly away.　And yellow leaves of autumn, which have no songs, flutter and fall there with a sigh. ',
			'The mighty desert is burning for the love of a blade of grass who shakes her head and laughs and flies away. ',
			'The sands in you way beg for your song and your movement,dancing　water.Will you carry the burden of their lameness? ',
			'Sorrow is hushed into peace in my heart like the evening among the silent trees. ',
			'I cannot choose the best. The best chooses me. ',
			'They throw their shadows before them who carry their lantern on their back. ',
			'Rest belongs to the work as the eyelids to the eyes. ',
			'the stars are not afraid to appear like fireflies. ',
			'The sparrow is sorry for the peacock at the burden of its tail. ',
			'“I give my whole water in joy,“ sings the waterfall, " though little of it is enough for the thirsty."',
			'The woodcutter\'s axe begged for its handle from tree, the tree gave it. ',
			'He who wants to do good knocks at the gate; he who loves finds the gate open. ',
			'The scabbard is content to be dull when it protects the keenness of the sword. ',
			'The cloud stood humbly in a corner of the sky, The morning crowned it with splendour. ',
			'The dust receives insult and in return offers her flowers. ',
			'God is ashamed when the prosperous boasts of his special favour. ',
			'Not hammer-strokes, but dance of the water sings the pebbles into perfection. ',
			'God\'s great power is in the gentle breeze, not in the storm. ',
			'By plucking her petals you do not gather the beauty of the flower. ',
			'The great walks with the small without fear. The middling keeps aloof. ',
			'" The learned say that your lights will one day be no more." said the firefly to the stars.The stars made no answer. ',
			'The pet dog suspects the universe for scheming to take its place. ',
			'Fruit is a noble cause, the cause of flower is sweet, but still let me in the obscurity of the shadow of the dedication to do it cause leaf.'
		);

		$background = array(
			'/static/images/bg/1.jpeg',
			'/static/images/bg/2.jpeg',
			'/static/images/bg/3.jpg',
			'/static/images/bg/4.jpg',
			'/static/images/bg/5.jpg',
			'/static/images/bg/6.jpg',
			'/static/images/bg/7.jpg',
			'/static/images/bg/8.jpg',
			'/static/images/bg/9.jpg',
			'/static/images/bg/10.jpg',
			'/static/images/bg/11.jpg',
			'/static/images/bg/12.jpg',
			'/static/images/bg/13.jpg',
			'/static/images/bg/14.jpg',
			'/static/images/bg/15.jpg',
			'/static/images/bg/16.jpg',
			'/static/images/bg/17.jpg',
			'/static/images/bg/18.jpg',
			'/static/images/bg/19.jpg',
			'/static/images/bg/20.jpg',
			'/static/images/bg/21.jpg',
			'/static/images/bg/22.jpg',
			'/static/images/bg/23.jpg',
			'/static/images/bg/24.jpg',
			'/static/images/bg/25.jpg',
			'/static/images/bg/26.jpg',
			'/static/images/bg/27.jpg',
			'/static/images/bg/28.jpg',
		);
		$poetry_index = mt_rand(0,count($poetry)-1);
		$background_index = mt_rand(0,count($background)-1);
		$data = array(
			'title'      => 'sdut.me',
			'poetry'     => $poetry[$poetry_index],
			'background' => $background[$background_index],
			'tpl'        => 'tpl_index',
		);
		$this->load->view('tpl_layout',$data);
	}

}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
