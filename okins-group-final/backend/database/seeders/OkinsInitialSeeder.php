<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\AdminUser;
use App\Models\CompanyProfile;
use App\Models\CompanyMission;
use App\Models\CompanyDivision;
use Illuminate\Support\Facades\Hash;
class OkinsInitialSeeder extends Seeder {
 public function run(): void {
  if (!env('OKINS_ADMIN_PASSWORD')) { throw new \\RuntimeException('Set OKINS_ADMIN_PASSWORD in .env before running this seeder.'); }
  AdminUser::updateOrCreate(['email'=>env('OKINS_ADMIN_EMAIL','admin@okinsgroup.com')],[
   'name'=>env('OKINS_ADMIN_NAME','Okins Administrator'),
   'password'=>Hash::make(env('OKINS_ADMIN_PASSWORD','')),
  ]);
  CompanyProfile::firstOrCreate([],[
   'name'=>'Okins Group',
   'description'=>'Okins Group hadir sebagai wadah kolaborasi untuk membantu masyarakat, memperkuat solidaritas kemanusiaan, dan menjaga kelestarian lingkungan hidup. Kami percaya perubahan besar dimulai dari kepedulian dan tindakan bersama.',
   'vision'=>'Menjadi perusahaan yang unggul, terpercaya, dan berdampak dalam membangun kehidupan manusia yang lebih baik serta menjaga kelestarian lingkungan hidup demi terwujudnya masa depan yang berkelanjutan bagi generasi mendatang.',
   'address'=>'Lengkapi alamat perusahaan','email'=>'info@okinsgroup.com','phone'=>'',
  ]);
  $missions=[
   'Mengembangkan kegiatan sosial dan kemanusiaan untuk membantu masyarakat yang membutuhkan serta meningkatkan kualitas kehidupan manusia.',
   'Berperan aktif dalam menjaga, melindungi, dan melestarikan lingkungan hidup melalui tindakan nyata dan berkelanjutan.',
   'Mendorong kemandirian masyarakat melalui edukasi, pendampingan, dan program pemberdayaan sosial.',
   'Membangun kemitraan dengan pemerintah, organisasi, komunitas, dan berbagai pihak untuk menciptakan dampak positif yang lebih luas.',
   'Mengembangkan solusi dan program inovatif yang mengintegrasikan kepentingan manusia, alam, dan pembangunan berkelanjutan.',
  ];
  foreach($missions as $i=>$m) CompanyMission::firstOrCreate(['content'=>$m],['sort_order'=>$i+1]);
  $divisions=[
   ['Aksi Kemanusiaan','Program kepedulian, bantuan kemanusiaan, dan dukungan bagi masyarakat yang membutuhkan.'],
   ['Lingkungan Hidup','Pelestarian alam, edukasi lingkungan, penghijauan, dan pengelolaan sumber daya secara bertanggung jawab.'],
   ['Pemberdayaan & Kolaborasi','Penguatan komunitas, relawan, edukasi, serta kemitraan lintas sektor untuk perubahan positif.'],
  ];
  foreach($divisions as $i=>$d) CompanyDivision::firstOrCreate(['name'=>$d[0]],['description'=>$d[1],'sort_order'=>$i+1]);
 }
}
