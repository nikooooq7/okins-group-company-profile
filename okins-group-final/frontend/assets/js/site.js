const copy = {
 id:{
  home:"Beranda",about:"Profil Perusahaan",divisions:"Lini Divisi",contact:"Kontak",eyebrow:"UNTUK KEMANUSIAAN, UNTUK BUMI",
  heroTitle:"Bersama Membangun Dunia yang Lebih Baik.",heroText:"Okins Group bergerak di bidang kemanusiaan dan lingkungan hidup melalui kolaborasi, kepedulian, serta aksi nyata untuk masa depan yang lebih baik.",learn:"Pelajari Lebih Lanjut ↗",contactUs:"Hubungi Kami",
  pillar1:"Kemanusiaan",pillar1d:"Peduli dan memberi arti",pillar2:"Lingkungan Hidup",pillar2d:"Menjaga alam dan kehidupan",pillar3:"Kolaborasi",pillar3d:"Bersama untuk dampak nyata",pillar4:"Keberlanjutan",pillar4d:"Untuk generasi mendatang",
  aboutLabel:"TENTANG KAMI",aboutText:"Okins Group hadir sebagai wadah kolaborasi untuk membantu masyarakat, memperkuat solidaritas kemanusiaan, dan menjaga kelestarian lingkungan hidup. Kami percaya perubahan besar dimulai dari kepedulian dan tindakan bersama.",vision:"Visi",mission:"Misi",
  valuesLabel:"PRINSIP YANG KAMI PEGANG",valuesTitle:"Nilai-Nilai Okins Group",humanityText:"Mengutamakan martabat, kepedulian, dan kesejahteraan manusia.",sustainText:"Menjaga alam dan sumber daya untuk generasi mendatang.",integrityText:"Bertindak jujur, transparan, dan bertanggung jawab.",collabText:"Bersinergi untuk menghadirkan perubahan yang berdampak.",
  divisionLabel:"BIDANG GERAK KAMI",divisionTitle:"Lini Divisi",divisionIntro:"Bidang gerak kami berfokus pada kepedulian sosial, perlindungan alam, dan kemitraan untuk dampak berkelanjutan.",
  ctaLabel:"MARI BERKOLABORASI",ctaTitle:"Mari bergandeng tangan menciptakan perubahan yang berarti.",ctaButton:"Hubungi Okins Group ↗",contactLabel:"HUBUNGI KAMI",contactTitle:"Kami siap mendengar dan berkolaborasi.",contactIntro:"Hubungi kami untuk program, kemitraan, kegiatan relawan, atau dukungan bagi inisiatif kemanusiaan dan lingkungan hidup.",address:"Alamat",phone:"Telepon",name:"Nama lengkap",message:"Pesan",send:"Kirim Pesan",footer:"Untuk kemanusiaan. Untuk bumi. Untuk masa depan.",rights:"Hak cipta dilindungi."
 },
 en:{
  home:"Home",about:"Company Profile",divisions:"Our Divisions",contact:"Contact",eyebrow:"FOR HUMANITY, FOR THE EARTH",
  heroTitle:"Together for a Better World.",heroText:"Okins Group works in humanitarian action and environmental care through collaboration, compassion, and practical initiatives for a better future.",learn:"Discover More ↗",contactUs:"Contact Us",
  pillar1:"Humanity",pillar1d:"Care that makes a difference",pillar2:"Environment",pillar2d:"Protecting nature and life",pillar3:"Collaboration",pillar3d:"Together for real impact",pillar4:"Sustainability",pillar4d:"For future generations",
  aboutLabel:"ABOUT US",aboutText:"Okins Group is a platform for collaboration to support communities, strengthen humanitarian solidarity, and protect the environment. We believe meaningful change begins with compassion and collective action.",vision:"Vision",mission:"Mission",
  valuesLabel:"OUR PRINCIPLES",valuesTitle:"Okins Group Values",humanityText:"Prioritizing human dignity, compassion, and well-being.",sustainText:"Protecting nature and resources for future generations.",integrityText:"Acting with honesty, transparency, and accountability.",collabText:"Working together to create meaningful impact.",
  divisionLabel:"OUR FOCUS AREAS",divisionTitle:"Our Divisions",divisionIntro:"Our work focuses on social care, environmental protection, and partnerships for sustainable impact.",
  ctaLabel:"LET'S COLLABORATE",ctaTitle:"Together, we can create meaningful change.",ctaButton:"Contact Okins Group ↗",contactLabel:"GET IN TOUCH",contactTitle:"We are ready to listen and collaborate.",contactIntro:"Contact us about our programs, partnerships, volunteering, or support for humanitarian and environmental initiatives.",address:"Address",phone:"Phone",name:"Full name",message:"Message",send:"Send Message",footer:"For humanity. For the earth. For a better future.",rights:"All rights reserved."
 }
};
const API=(window.OKINS_CONFIG?.API_BASE_URL||"").replace(/\/$/,"");
const defaultVision="Menjadi perusahaan yang unggul, terpercaya, dan berdampak dalam membangun kehidupan manusia yang lebih baik serta menjaga kelestarian lingkungan hidup demi terwujudnya masa depan yang berkelanjutan bagi generasi mendatang.";
const defaultMissions=[
"Mengembangkan kegiatan sosial dan kemanusiaan untuk membantu masyarakat yang membutuhkan serta meningkatkan kualitas kehidupan manusia.",
"Berperan aktif dalam menjaga, melindungi, dan melestarikan lingkungan hidup melalui tindakan nyata dan berkelanjutan.",
"Mendorong kemandirian masyarakat melalui edukasi, pendampingan, dan program pemberdayaan sosial.",
"Membangun kemitraan dengan pemerintah, organisasi, komunitas, dan berbagai pihak untuk menciptakan dampak positif yang lebih luas.",
"Mengembangkan solusi dan program inovatif yang mengintegrasikan kepentingan manusia, alam, dan pembangunan berkelanjutan."
];
function langSet(lang){
 document.documentElement.lang=lang;
 document.querySelectorAll("[data-i18n]").forEach(el=>{const k=el.dataset.i18n;if(copy[lang][k])el.textContent=copy[lang][k]});
 localStorage.setItem("okins-lang",lang);
}
const lang=document.getElementById("lang");lang.value=localStorage.getItem("okins-lang")||"id";langSet(lang.value);lang.addEventListener("change",e=>langSet(e.target.value));
document.getElementById("year").textContent=new Date().getFullYear();
document.getElementById("mobile-toggle").addEventListener("click",()=>document.getElementById("mobile-nav").classList.toggle("hidden"));
document.querySelectorAll("#mobile-nav a").forEach(a=>a.addEventListener("click",()=>document.getElementById("mobile-nav").classList.add("hidden")));
function safeText(value){return String(value??"").replace(/[&<>"']/g,c=>({"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;"}[c]));}
async function loadPublicContent(){
 if(!API||API.includes("YOUR-LARAVEL"))return;
 try{
  const r=await fetch(`${API}/public-content`);if(!r.ok)return;const d=await r.json();
  if(d.profile){document.getElementById("company-name").textContent=d.profile.name||"Okins Group";document.getElementById("company-description").textContent=d.profile.description||"";document.getElementById("vision-text").textContent=d.profile.vision||defaultVision;document.getElementById("company-address").textContent=d.profile.address||"Informasi alamat belum tersedia";document.getElementById("company-email").textContent=d.profile.email||"";document.getElementById("company-phone").textContent=d.profile.phone||"";}
  const missions=d.missions?.length?d.missions.map(x=>x.content):defaultMissions;
  document.getElementById("mission-list").innerHTML=missions.map(x=>`<li>${safeText(x)}</li>`).join("");
  if(d.divisions?.length)document.getElementById("division-cards").innerHTML=d.divisions.map((x,i)=>`<article class="division-card"><span>${String(i+1).padStart(2,"0")}</span><h3>${safeText(x.name)}</h3><p>${safeText(x.description)}</p></article>`).join("");
 }catch(e){console.warn("Konten API belum tersedia; menampilkan konten bawaan.",e);}
}
loadPublicContent();
document.getElementById("contact-form").addEventListener("submit",async e=>{
 e.preventDefault();const status=document.getElementById("form-status"),payload=Object.fromEntries(new FormData(e.currentTarget));
 if(!API||API.includes("YOUR-LARAVEL")){status.textContent="Form belum aktif. Backend Laravel perlu dipasang dan URL API diatur terlebih dahulu.";return;}
 status.textContent="Mengirim pesan...";
 try{const r=await fetch(`${API}/contact`,{method:"POST",headers:{"Content-Type":"application/json","Accept":"application/json"},body:JSON.stringify(payload)});const d=await r.json();if(!r.ok)throw new Error(d.message||"Gagal mengirim");status.textContent=d.message||"Pesan berhasil dikirim. Terima kasih.";e.currentTarget.reset();}
 catch(err){status.textContent="Pesan belum terkirim. Silakan coba kembali atau hubungi kami melalui email.";}
});
