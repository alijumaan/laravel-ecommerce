<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('pages')->insert([
            'title' => "About us",
            'slug' => "about",
            'content' => "<p><span style='font-size: 14.4px;'></span></p><p><span style='font-size: 14.4px;'><p>Parturient dictumst posuere proin aliquam bibendum congue at, est quis mi aliquet non litora. Parturient tempus lectus molestie tristique dapibus ultrices sociosqu, ornare cubilia rhoncus aptent ullamcorper.</p><br></span><br></p>",
            'status' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('pages')->insert([
            'title' => "Privacy policy",
            'slug' => "privacy-policy",
            'content' => "<p><span style='font-size: 14.4px;'></span></p><p><span style='font-size: 14.4px;'><p>Lorem ipsum dolor sit amet consectetur adipiscing elit curae, convallis sodales arcu dictumst cum senectus tempus. Odio phasellus venenatis neque nec ultrices nam consequat morbi, urna integer ligula est libero condimentum etiam mattis, torquent aptent facilisis cursus lobortis fusce augue. Feugiat urna mollis luctus class, porta duis curae facilisis, neque in netus. A vivamus lacus nibh tortor dictum hendrerit magna eleifend, dapibus fringilla sociis volutpat egestas dui tempor, netus nulla habitasse torquent rutrum nec lectus. Suscipit fermentum curae odio nisi habitant mattis posuere aliquet blandit, vulputate libero phasellus scelerisque tristique viverra lacus. Suspendisse dictumst dignissim mattis eget faucibus facilisis aenean quis taciti, posuere urna primis vehicula eu lacinia platea cum sapien habitant, aliquet pharetra donec cursus fringilla ultricies fermentum magnis. Dictum proin lacinia turpis ligula cras torquent blandit maecenas, bibendum convallis venenatis suspendisse rutrum quam nibh consequat augue, taciti rhoncus eros vestibulum faucibus congue enim.</p> <p>Suspendisse ornare interdum platea turpis sagittis iaculis curae et, vitae risus lacus venenatis ad tristique. Integer inceptos nostra molestie aliquet semper nunc augue, habitant pulvinar nulla tortor sagittis in, libero dignissim cum enim metus cubilia. Bibendum maecenas proin pellentesque ad augue lectus gravida dapibus erat litora ullamcorper parturient eleifend, aliquam ultricies sem mattis nunc class molestie elementum in vestibulum est hendrerit. Felis duis dui vitae morbi neque id rutrum rhoncus, habitant libero mi magna mauris ridiculus vulputate arcu fermentum, nibh turpis cubilia gravida litora ante in.</p> <p>Vulputate placerat augue mollis vehicula id sodales faucibus ullamcorper, vestibulum urna auctor pretium aliquam aptent semper volutpat taciti, porta commodo duis senectus nullam et vitae. Nascetur odio est rutrum fames fusce tellus integer, neque congue aliquam ligula turpis iaculis, vivamus magna taciti pretium lacus leo. Aenean cum bibendum velit senectus purus lacinia conubia ac nascetur ante, malesuada scelerisque condimentum ultrices nam quis eros proin id, pharetra augue pretium aptent turpis enim gravida congue odio. Potenti felis urna rhoncus inceptos tellus maecenas quis curabitur fringilla, morbi arcu sociosqu rutrum nulla natoque volutpat viverra aliquam, fames habitant lectus hac tortor metus vulputate risus. Suspendisse lobortis vivamus dignissim blandit et nec tempor curabitur sociis, nisl risus neque suscipit sodales congue integer lectus, est sociosqu elementum cubilia per gravida praesent ultricies. Nisl maecenas volutpat vestibulum enim litora penatibus velit habitant suspendisse primis, laoreet lacus placerat ligula nec imperdiet ac curabitur dictum, sapien duis aenean lobortis pretium mollis sagittis condimentum commodo.</p> <p>Lacus porttitor scelerisque senectus conubia commodo pretium eleifend fringilla, eu dictumst tellus urna integer suspendisse tempor id nunc, bibendum turpis malesuada netus erat nec quisque. Interdum ullamcorper ornare pharetra aliquam non odio tincidunt inceptos vel a dapibus pellentesque, scelerisque accumsan quis hac bibendum vestibulum platea tempor quam donec. Ullamcorper justo dictum quisque nec risus pellentesque commodo ligula est, dignissim tellus integer nulla sodales imperdiet aptent felis, aenean urna nullam vulputate erat varius phasellus donec. Vulputate aliquam vel lectus tempor urna tortor tristique est, molestie aliquet imperdiet pretium eros justo fringilla, sapien magnis nisl facilisis malesuada placerat scelerisque. Cras dis urna vehicula pretium sociis potenti curae ut dui, posuere mollis neque justo a habitasse curabitur scelerisque nascetur magnis, ridiculus taciti morbi lobortis senectus hendrerit montes habitant. Tempor pulvinar ullamcorper risus nostra aenean, consequat vitae dis metus per aptent, convallis taciti purus pharetra. Vestibulum nascetur mi ornare id potenti tristique, felis habitant diam volutpat velit elementum ridiculus, ullamcorper auctor convallis pulvinar erat. Enim neque sodales libero praesent diam torquent penatibus, egestas viverra lacus varius suscipit suspendisse cursus habitasse, metus sed rhoncus habitant pellentesque curae. Fringilla luctus nulla aenean tortor parturient arcu, porttitor himenaeos odio erat cras lobortis pellentesque, class nisi cubilia mus sociis.</p> <p>Est vitae velit etiam sociis commodo ac curae porttitor hendrerit, turpis libero dignissim lectus sapien netus nunc egestas, feugiat aenean fusce ultrices donec ornare per et. Sociosqu imperdiet maecenas class facilisi habitasse magna pharetra mollis, netus integer pellentesque sem curae massa taciti nunc tristique, mattis sociis elementum per quis ultrices quam. Aliquet convallis tincidunt aptent porta hendrerit auctor et id, pretium metus cras maecenas eget pharetra consequat felis, orci magnis fames ultrices ullamcorper mollis scelerisque. Vel pulvinar sollicitudin dignissim eu proin integer pretium, iaculis ac lobortis rutrum cum taciti tincidunt, ut ultricies lacinia sociosqu egestas per. Ullamcorper torquent neque nec dictumst tempus facilisis aptent fusce scelerisque, erat pellentesque dapibus condimentum nulla pulvinar auctor montes, ultrices magna molestie sagittis elementum facilisi quisque porttitor.</p> <p>Feugiat inceptos purus aenean est dictumst donec in, class pretium eget accumsan congue cursus tincidunt imperdiet, suspendisse fusce quam per ad hac. Aliquam magnis nulla turpis dignissim duis id mus montes ut, dis bibendum nisi per massa et habitant sem nec dictum, aliquet mollis sociosqu magna convallis habitasse augue cubilia. Sollicitudin eget parturient tincidunt ultricies metus in non iaculis, suscipit lacus sociosqu proin fermentum convallis egestas quisque et, mus curabitur vitae donec felis tristique conubia. Odio auctor vivamus hendrerit et eros, ridiculus taciti purus leo primis, ac montes facilisis sociosqu. Rhoncus habitant iaculis fermentum arcu dictum scelerisque mollis tempor erat varius, dis ullamcorper cubilia congue sodales auctor et neque condimentum. Et inceptos est mus tristique urna diam rhoncus, libero magnis nam venenatis tellus hac commodo, augue primis arcu faucibus senectus fames. Nulla arcu justo sed tellus placerat, metus augue donec nullam, potenti natoque ut tortor. Parturient dictumst posuere proin aliquam bibendum congue at, est quis mi aliquet non litora. Parturient tempus lectus molestie tristique dapibus ultrices sociosqu, ornare cubilia rhoncus aptent ullamcorper.</p><br></span><br></p>",
            'status' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('pages')->insert([
            'title' => "FAQ page",
            'slug' => "faq-page",
            'content' => "<p><span style='font-size: 14.4px;'></span></p><p><span style='font-size: 14.4px;'><p>Lorem ipsum dolor sit amet consectetur adipiscing elit curae, Et inceptos est mus tristique urna diam rhoncus, libero magnis nam venenatis tellus hac commodo, augue primis arcu faucibus senectus fames. Nulla arcu justo sed tellus placerat, metus augue donec nullam, potenti natoque ut tortor. Parturient dictumst posuere proin aliquam bibendum congue at, est quis mi aliquet non litora. Parturient tempus lectus molestie tristique dapibus ultrices sociosqu, ornare cubilia rhoncus aptent ullamcorper.</p></span><br></p>",
            'status' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('pages')->insert([
            'title' => "Terms and conditions",
            'slug' => "terms-and-conditions",
            'content' => "<p><span style='font-size: 14.4px;'></span></p><p><span style='font-size: 14.4px;'><p>Metus augue donec nullam, potenti natoque ut tortor. Parturient dictumst posuere proin aliquam bibendum congue at, est quis mi aliquet non litora. Parturient tempus lectus molestie tristique dapibus ultrices sociosqu, ornare cubilia rhoncus aptent ullamcorper.</p><br></span><br></p>",
            'status' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
