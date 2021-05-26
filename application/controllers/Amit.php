<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once './vendor/autoload.php';

use Aws\CloudFront\CloudFrontClient;

class Amit extends CI_Controller {

    public $key;

    public function __construct() {
        parent::__construct();
        $key = "-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEAs5YRm/cCA0rb7ex6W0SPRnEJfz9KIB//lTl8FOFh6mAgh78U
KNpxTqi9Ji/RrgGQlc4ePThq8gqw3MyZwSD0HvB+MnSYSxaEOIPgo6nV/10scoK0
vc8fyZJcSAer9Ou1XHpLl38A8NNRUoFvOz38vnA+22q30+mZAYkDRGPU/7uKfsrM
lAryU/GnyJahZYRHCQWizmHPdLQL0NTXxcjHBDfMfluOSDwm/PHtLr4tIrT/vk6k
62zU8U4FzNUYVVgOKyrm2rIySkAh+mDV1ulAso/AlB8fvf3qvE/gXFs3+p5E60XH
fZKMeijc84oP72/4KuDnuxtgaQQhMyXgBXKMeQIDAQABAoIBAGTnQfem/uuIqS/y
ugED8Zi7tIFZtzV7pShcRzqYNGLzJfP/ybz2l8mBh92n6qFhYbK6QEVXqMdceGln
UFCySlgD+nQxDMzL1vjGKHbs2z+DQ5EHnbQ0Z4DjipQyM00HDzzpvgVeJ9Ioeb3o
2e2oc5UxDjBMswMPcpfpOvu3OBuDeiAPR7Wef4UPTE3U3eJNSSjQGY/+OS/Y4Spr
e+svgZdkgeM7l2Ev7QY50ey6+UQ6qi6B1PWqs9EGYy5KkavS54rCrx0agy/viot6
LSsKumhKl5YatnRhvwcq4w/8VlV4/LAXV/csr7PyBcXwet/2XH2gRcHSUaoNcfZd
cG++rDECgYEA9gIXcYKgkl2hf26ur6zXGirRDcWegw22bPT4qca/JRUFB78C4Quy
7nINwSoQAmgV6JC32kqscXCpNEb7iAeNN5RqxfQdLNWJ7DCjzwPZDC32YYj6Ptsj
EevJ9gpUM6vWti7MdJPYXejTq4dzHzqde0NM8uu1htr6OnM0NhA8iW0CgYEAuuFY
LfaHryvfuz/yBuAtdCCKkGdHepshrm/DW6kSLacov55ZGLYyba1OP0kwE0cjqmrC
2eX9l5/4CqFY8ty2EAXr0uYVi09cDtIqlqZKwNVnfYDM9RThn1k0F/LM+IvEy+MU
Qns9HruzhatBXR2Rq2v0vCDesG4dD7vzXloGE70CgYEAv6aBfPy2+0/WMOCZVmLg
cJJKqt/5zT8xj1CJKDqdTtZBRPeZ1pi2nOxdqs6KClXsO3ICyRzDmtyZ9RAXhLHd
Yh9Nz0mOMQ9qk4aRFwV4YfSsrO95hN5TQ/LdM8B4OIj2jJeI0IkdVou72zV6iimv
5gdYOydGE/kkV8TIOBYOE0ECgYB55Zsa//+pJzkcbq10Bq4fXUqEvplFRANIQOZw
12tgE/TkaGk9UTq7h5vOc/LD4FdHRbQrZXVwfYvRg0T9xTGMahBU1HehEva9RCE7
euSvu4NxvZ3zDtfMlOcB6AIC7UhEpa4FX1WSwmRrADX2gt8NrbFJNTeMZYbXSIWK
ObZVEQKBgG5zBuYxOjXqqWs9ztmslz5oXz3T05sqZ/crneiRK/sy6fQkB3jVxsjP
FT1SHcoh0ehF+DrOskXvuuRgA0d9Mpm/UJD8qwy7IW5diQAR+Dc2vdjwY7s17qmD
UDPi4EWzN8amgq76zhHHcc1Vc+95HCmbtJ3SSV3yba3pDjspKApb
-----END RSA PRIVATE KEY-----";
        $this->key = $key;
    }

    public function index() {
        echo "hi amit";
    }

    public function test4() {
//        awsvideo.website.com



        $urlCloud = 'https://d1q6j9as6cq5o.cloudfront.net';
        $privateKey = base_url("key/pk-APKAJHEEYSUJNRQVEL5Q.pem");
        $cloudfront = Aws\CloudFront\CloudFrontClient::factory([
                    'profile' => 'default',
                    'version' => 'latest',
                    'region' => 'ap-south-1',
//                    'key_pair_id' => 'APKAJHEEYSUJNRQVEL5Q',
//                    'private_key' => $this->key,
        ]);
        $object = 'intallsetup.mp4';
        $expiry = new DateTime('+10000 minutes');
        $url = $cloudfront->getSignedUrl([
            'url' => "{$urlCloud}/{$object}",
            'expires' => $expiry->getTimestamp(),
            'key_pair_id' => 'APKAJHEEYSUJNRQVEL5Q',
            'private_key' => $this->key,
        ]);
        echo "$url <br/>";
        ?>
        <video controls="" width="500px">
            <source src="<?php echo $url; ?>" type="video/mp4">
        </video>
        <?php
    }

    public function test2() {
        $url = "https://d1q6j9as6cq5o.cloudfront.net/welcome.mp4?Expires=2182189258&Signature=EdLZgOjU6isN0GCjsTWvIRad5OEpMNZVjU7Wq06DcnqlrNYwCJHjdYS1A1~ha0HECizM3Fr5RzV-59iOYRitV46B57--PEpSIp5dejvpn08K1DzS6q9agNAhcupiGwmLCR1CwNcg430Mbw4V6d8jIBNfr3q40E1YS96YD~Uoow3PxAh7lQCkK421hAK2630cuobbgO2aLp72di3Ki4I7E3nB9mmg4zNONqTV-HhhwFayYx7evctoEpRrFv1bbharBS~nTqv5ai4rMV9bcuHL0IdV0n44FQDAWBXkalg1F8zdJg0L-xHeAebP1aCIXE3mZW-1J7tactQ0JlrPxI5b8Q__&Key-Pair-Id=APKAJHEEYSUJNRQVEL5Q";
        ?>
        <video controls="" width="500px">
            <source src="<?php echo $url; ?>" type="video/mp4">
        </video>
        <?php
    }

    public function test() {
        $cc = "";
        $sharing = "";
        $url = "https://d1q6j9as6cq5o.cloudfront.net/welcome.mp4?Expires=2182189258&Signature=EdLZgOjU6isN0GCjsTWvIRad5OEpMNZVjU7Wq06DcnqlrNYwCJHjdYS1A1~ha0HECizM3Fr5RzV-59iOYRitV46B57--PEpSIp5dejvpn08K1DzS6q9agNAhcupiGwmLCR1CwNcg430Mbw4V6d8jIBNfr3q40E1YS96YD~Uoow3PxAh7lQCkK421hAK2630cuobbgO2aLp72di3Ki4I7E3nB9mmg4zNONqTV-HhhwFayYx7evctoEpRrFv1bbharBS~nTqv5ai4rMV9bcuHL0IdV0n44FQDAWBXkalg1F8zdJg0L-xHeAebP1aCIXE3mZW-1J7tactQ0JlrPxI5b8Q__&Key-Pair-Id=APKAJHEEYSUJNRQVEL5Q";
        ?>

        <html>
            <head>
            </head>
            <body>
                <div class='video'>
                    <script src="https://use.fontawesome.com/20603b964f.js"></script>
                    <script type="text/javascript" src="https://content.jwplatform.com/libraries/LJ361JYj.js"></script>
                    <script type="text/javascript">jwplayer.key = 'ypdL3Acgwp4Uh2/LDE9dYh3W/EPwDMuA2yid4ytssfI=';</script><div id="myElement"></div><script type="text/javascript">
                                jwplayer("myElement").setup({
                                    image: "https://content.jwplatform.com/thumbs/xJ7Wcodt-720.jpg",
                                    aspectratio: "16:9",
                                    width: '100%',
                                    aspectratio: '16:9',
                                    autostart: false,
                                    file: '<?php echo $url; ?>',
                                    abouttext: 'FILMKACA',
                                    aboutlink: 'http://filmkaca.xyz',
                                    tracks: [{"file": "<?php echo $cc; ?>", "label": "Indonesia", "kind": "captions", "default": "true"}],
                                    captions: {color: '#ffb800', fontSize: 30, backgroundOpacity: 0},
                                    sharing: {
                                        sites: ['facebook', 'twitter', 'tumblr', 'googleplus', {icon: '//support-static.jwplayer.com/images/awesome.svg', src: 'http://www.jwplayer.com/?', label: 'jwplayer'}],
                                        code: encodeURI("<iframe src='<?php echo $sharing; ?>' width='480' height='320'></iframe>"),
                                        link: "<?php echo $sharing; ?>"
                                    }
                                })
                    </script>
                </div>
            </body>
        </html>
        <?php
    }

}
