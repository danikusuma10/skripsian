
<link rel="stylesheet" media="screen" href="css/style.css">

<script src="<?= base_url('assets/'); ?>particle/particles.js"></script>

<script src="<?= base_url('assets/'); ?>particle/app.js"></script>


<div id="particles-js">

  <div class="banner" style="width: 500px;background: rgba(255,255,255,0.5); position: absolute; top:40%;left:30%;text-align: center;padding: 20px">

    <h1>Membuat Background Animasi Bergerak Menggunakan Particle.js</h1>

  </div>

</div>




<script>

  /* ---- particles.js config ---- */

particlesJS("particles-js", {

  "particles": {

    "number": {

      "value": 100,

      "density": {

        "enable": true,

        "value_area": 800

      }

    },

    "color": {

      "value": "#ffffff"

    },

    "shape": {

      "type": "circle",

      "stroke": {

        "width": 2,

        "color": "#ffffff"

      },

      "polygon": {

        "nb_sides": 5

      },

      "image": {

        "src": "img/github.svg",

        "width": 100,

        "height": 100

      }

    },

    "opacity": {

      "value": 0.5,

      "random": false,

      "anim": {

        "enable": false,

        "speed": 1,

        "opacity_min": 0.1,

        "sync": false

      }

    },

    "size": {

      "value": 50,

      "random": true,

      "anim": {

        "enable": false,

        "speed": 40,

        "size_min": 0.1,

        "sync": false

      }

    },

    "line_linked": {

      "enable": true,

      "distance": 150,

      "color": "#ffffff",

      "opacity": 0.4,

      "width": 1

    },

    "move": {

      "enable": true,

      "speed": 6,

      "direction": "none",

      "random": false,

      "straight": false,

      "out_mode": "out",

      "bounce": false,

      "attract": {

        "enable": false,

        "rotateX": 600,

        "rotateY": 1200

      }

    }

  },

  "interactivity": {

    "detect_on": "canvas",

    "events": {

      "onhover": {

        "enable": true,

        "mode": "repulse"

      },

      "onclick": {

        "enable": true,

        "mode": "push"

      },

      "resize": true

    },

    "modes": {

      "grab": {

        "distance": 140,

        "line_linked": {

          "opacity": 1

        }

      },

      "bubble": {

        "distance": 400,

        "size": 40,

        "duration": 2,

        "opacity": 8,

        "speed": 3

      },

      "repulse": {

        "distance": 200,

        "duration": 0.4

      },

      "push": {

        "particles_nb": 4

      },

      "remove": {

        "particles_nb": 2

      }

    }

  },

  "retina_detect": true

});

</script>