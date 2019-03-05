<?php

use Illuminate\Database\Seeder;

class NoticiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('noticias')->insert([
            [
                'titulo'        => 'Ut blandit',
                'categoria_id'  => 1,
                'texto'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur blandit maximus semper. Vestibulum vel pulvinar ex, ut hendrerit libero. Ut blandit fringilla est, in ornare neque vulputate eget. Sed scelerisque urna velit, et tempor lacus volutpat non. Praesent lobortis consequat vehicula. Mauris tempus, est sit amet hendrerit gravida, libero mauris lobortis metus, vel varius arcu quam ac nisi. Maecenas id porta urna. Mauris vulputate rutrum nunc a aliquet. Fusce pharetra dignissim quam, eget tincidunt purus aliquet sed. Proin fermentum, elit quis venenatis imperdiet, orci dui lacinia ipsum, at facilisis massa ex sed nisl. Fusce efficitur magna dui, et auctor velit condimentum eu. Vivamus lobortis tincidunt tellus, sed consectetur diam congue eu. Nunc egestas venenatis mi at feugiat. Vivamus vestibulum vitae arcu at sagittis.',
                'url_foto'      => '',
                'created_at'    => now()
            ],
            [
                'titulo'        => 'Pellentesque nunc',
                'categoria_id'  => 2,
                'texto'         => 'Pellentesque nunc nibh, venenatis non viverra in, sollicitudin vitae tortor. Nam et elit aliquam, tempus felis a, auctor ex. Curabitur molestie eros eu mauris convallis, sit amet egestas diam imperdiet. Donec ac nibh in libero malesuada gravida vel at neque. Aenean a velit libero. Donec pulvinar ultrices erat et congue. Pellentesque ut maximus arcu, sed commodo nisi. Suspendisse justo erat, consequat eleifend arcu eu, ullamcorper tempor nulla. Donec commodo lorem nec dapibus efficitur. Mauris tellus odio, vulputate ac mi at, sodales sodales lectus. Maecenas dignissim, sem eu aliquam pellentesque, tellus mi blandit ex, in aliquam turpis leo eu velit. Nulla rhoncus tristique feugiat. Nulla egestas magna eros, lacinia malesuada turpis accumsan ac.',
                'url_foto'      => '',
                'created_at'    => now()
            ],
            [
                'titulo'        => 'Pellentesque habitant',
                'categoria_id'  => 2,
                'texto'         => 'Suspendisse efficitur aliquam ligula vel finibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque eget lorem vitae ante gravida aliquam accumsan eu est. Aliquam egestas nisi erat, vel efficitur nisi accumsan nec. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi aliquam nisl sit amet odio eleifend venenatis. Curabitur vehicula massa felis, nec pulvinar est convallis eget. Proin convallis vehicula augue. Vestibulum mauris augue, varius fermentum sapien vitae, sagittis tincidunt justo. Vivamus id lorem nec lorem porta condimentum placerat at dui. Nam quis urna id turpis luctus vestibulum. Integer faucibus urna nisi, eu imperdiet arcu cursus non. Etiam rhoncus eu risus eget pulvinar. Donec vulputate nisi arcu, nec lacinia ligula vehicula nec. Mauris euismod dolor lorem, at commodo tortor eleifend vitae.',
                'url_foto'      => '',
                'created_at'    => now()
            ],
            [
                'titulo'        => 'Vivamus id lorem',
                'categoria_id'  => 3,
                'texto'         => 'Nulla pulvinar vehicula venenatis. Nulla hendrerit, tortor in dictum malesuada, ante purus rhoncus turpis, sit amet condimentum sapien ante vel turpis. Cras ac orci quis elit ultricies accumsan ac nec mi. Sed eget urna consectetur, pellentesque elit non, accumsan magna. Nulla vel tellus velit. Donec laoreet sollicitudin dictum. Curabitur accumsan, lectus facilisis pharetra scelerisque, mi est viverra justo, vitae lobortis ipsum magna eu purus. Quisque vel tristique neque. Donec at facilisis nunc, quis mollis lectus. Morbi quis diam gravida, vulputate metus pellentesque, commodo nibh.',
                'url_foto'      => '',
                'created_at'    => now()
            ],
            [
                'titulo'        => 'Nulla hendrerit',
                'categoria_id'  => 1,
                'texto'         => 'Nulla facilisi. Nulla vehicula sem vitae elit rhoncus, vel faucibus dui lacinia. Duis aliquam rutrum nisi ac auctor. Etiam at lorem et ex imperdiet porta et sed leo. Sed orci mi, fermentum ac faucibus at, ornare vitae erat. Nulla vitae velit mauris. Nullam eu ligula rutrum, tempus elit ac, auctor nibh. Nullam pharetra est ut risus volutpat, in rutrum orci hendrerit. Donec aliquet auctor urna ac imperdiet. Morbi facilisis vestibulum pretium. Nam sit amet auctor felis. Donec tincidunt porttitor elementum.',
                'url_foto'      => '',
                'created_at'    => now()
            ]
        ]);
    }
}
