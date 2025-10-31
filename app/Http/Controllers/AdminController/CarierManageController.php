<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carier;
use App\Models\Skills;

class CarierManageController extends Controller
{
    public function index()
    {
        $cariers = Carier::all();
        $menu = 'Carier';
        return view('admin.carier.index', compact('cariers', 'menu'));

    }

    public function create()
    {
        $skills = Skills::all();
        $menu = 'Add Carier';
        return view('admin.carier.create', compact('skills','menu'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        $logoPath = $this->handleLogoUpload($request);
        $skillsData = json_encode($validated['skills']);

        Carier::create([
            'company_name' => $validated['company_name'],
            'job_status' => $validated['job_status'],
            'role' => $validated['role'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? null,
            'current_status' => $validated['current_status'] ?? null,
            'logo' => $logoPath,
            'description' => $validated['description'], 
            'skills' => $skillsData,
        ]);

        return redirect()->route('carier.admin.index')->with('success', 'Data karier berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $carier = Carier::findOrFail($id);
        $skills = Skills::all(); // Ambil semua keahlian
        $menu = 'Add Carier';
        // Mengubah string JSON menjadi array
        $carierSkills = !empty($carier->skills) ? json_decode($carier->skills, true) : [];

        return view('admin.carier.edit', compact('skills', 'carier', 'carierSkills','menu'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'job_status' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'current_status' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string',
            'skills' => 'array',
        ]);

    
     

        $carier = Carier::findOrFail($id);
        
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        } else {
            $logoPath = $carier->logo; // Jika tidak ada logo baru, gunakan yang lama
        }
        
        if ($request->skillold == 'no') {
            $skillsData = Carier::findOrFail($id)->skills;
        } else {
            // Mengubah array keahlian menjadi string JSON
            $skillsData = json_encode($validated['skills']);
        }
        
        $carier->update([
            'company_name' => $validated['company_name'],
            'job_status' => $validated['job_status'],
            'role' => $validated['role'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? null,
            'current_status' => $validated['current_status'] ?? null,
            'logo' => $logoPath,
            'description' => $validated['description'], // Gunakan deskripsi yang sudah dibersihkan
            'skills' => $skillsData,
        ]);

        return redirect()->route('carier.admin.index')->with('success', 'Data karier berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $carier = Carier::findOrFail($id);
        $this->deleteLogo($carier->logo);
        $carier->delete();

        return redirect()->route('carier.admin.index')->with('success', 'Data karier berhasil dihapus.');
    }

    public function deleteAll()
    {
        Carier::truncate();
        return redirect()->route('carier.admin.index')->with('success', 'Semua data karier berhasil dihapus.');
    }

    public function injectSkills()
    {
        $newSkills = $this->getNewSkills();
        $insertedSkills = [];
   
        foreach ($newSkills as $skill) {
            if (!empty($skill)) {
                try {
                    Skills::create(['skill_name' => $skill]);
                    $insertedSkills[] = $skill;
                } catch (\Exception $e) {
                    \Log::error('Error inserting skill: ' . $skill . ' - ' . $e->getMessage());
                }
            } else {
                \Log::warning('Skill is empty, skipping...');
            }
        }

        return response()->json(['message' => count($insertedSkills) . ' data keahlian berhasil dimasukkan.']);
    }

    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'company_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'job_status' => 'required|string|max:255',
            'start_date' => 'required|date',
            'description' => 'required|string',
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'skills' => 'nullable|array',
        ]);
    }

    private function handleLogoUpload(Request $request): ?string
    {
        if ($request->hasFile('logo')) {
            return $request->file('logo')->store('logos', 'public');
        }
        return null;
    }

    private function deleteLogo(?string $logoPath): void
    {
        if ($logoPath) {
            \Storage::delete('public/' . $logoPath);
        }
    }
    private function getNewSkills(): array
    {
        return [
            // Pengembangan Web
            'Pengembangan Aplikasi Web', 'Desain Web Responsif', 'HTML5 & CSS3', 'JavaScript', 'PHP (Laravel)', 
            'Frontend Development', 'Backend Development', 'Full Stack Development', 'Web Performance Optimization', 
            'Content Management Systems (CMS)', 'E-commerce Development', 'SEO Web Development', 
            'Web Application Security', 'Web API Development (RESTful, GraphQL)', 'Web Accessibility Standards', 
            'Web Design and User Experience', 'Progressive Web Apps (PWA)', 'Website Speed Optimization', 
            'Cross-Browser Compatibility', 'JavaScript Frameworks (React, Vue, Angular)', 
            'HTML/CSS Frameworks (Bootstrap, TailwindCSS)', 'Vue.js Development', 'Node.js Backend Development', 
            'Sass and SCSS (CSS Preprocessing)', 'Server-side Scripting', 'Responsive Web Design', 
            'Mobile Web Development', 'API Integration', 'Web Scraping Techniques', 'Content Delivery Networks (CDN)', 
            'Web Analytics Integration', 'Version Control Systems (Git)', 'Test-Driven Development (TDD)', 
            'Agile Web Development', 'Continuous Integration/Continuous Deployment (CI/CD)', 
            'Software Testing (Unit, Functional, E2E)', 'Web Security Best Practices', 'Database Management and Optimization', 
            'SEO for Web Development', 'Cross-Platform App Development', 'Serverless Web Apps', 
            'Cloud Hosting (AWS, GCP, Azure)', 'App Store Optimization', 'Real-Time Web Applications',
            'PWA Implementation', 'WebSockets for Real-time Apps', 'Progressive Enhancement', 'Webpack Bundling', 
            'Responsive Images', 'CSS Grid Layout', 'Flexbox Layout', 'SEO Friendly Code', 'Automated Testing', 
            'TypeScript for JavaScript', 'JavaScript ES6+', 'Mobile Optimization', 'Web Accessibility', 
            'Web Project Management', 'Web Design Frameworks (Tailwind CSS, Bootstrap)', 
            'Website Maintenance and Optimization', 'Mobile App Integration', 'Custom Web Animations', 
            'Web Usability', 'Custom JavaScript Libraries',

            // Teknologi Informasi
            'Manajemen Basis Data', 'Database Design', 'MySQL', 'PostgreSQL', 'MongoDB', 'NoSQL Databases', 
            'Database Query Optimization', 'Data Warehousing', 'Cloud Computing', 'Infrastructure as a Service (IaaS)', 
            'Platform as a Service (PaaS)', 'Software as a Service (SaaS)', 'Amazon Web Services (AWS)', 
            'Google Cloud Platform (GCP)', 'Microsoft Azure', 'Big Data Technologies', 'Data Mining and Analysis', 
            'Data Visualization', 'Business Intelligence (BI)', 'Machine Learning and AI', 
            'Automation in IT Operations', 'Internet of Things (IoT)', 'Cyber Security and Ethical Hacking', 
            'Cloud Security', 'Penetration Testing', 'Firewalls and VPNs', 'System Administration', 
            'Network Configuration and Management', 'Data Center Management', 'IT Support and Troubleshooting', 
            'IT Project Management', 'Software Development Life Cycle (SDLC)', 'Agile Methodologies', 
            'IT Service Management (ITSM)', 'Disaster Recovery and Backup Solutions', 'Compliance and IT Auditing', 
            'Virtualization Technologies', 'DevOps Practices', 'Containerization (Docker, Kubernetes)', 
            'IT Governance', 'Technology Integration', 'Technology Consulting', 'Business Continuity Planning', 
            'Risk Management in IT', 'Change Management in IT', 'Digital Transformation', 'Data Encryption', 
            'Secure Software Development', 'Artificial Intelligence and Robotics', 'Blockchain Technology', 
            'IoT Device Management', 'Quantum Computing (Emerging)', '5G Technology', 'Augmented Reality (AR)', 
            'Virtual Reality (VR)', 'Predictive Analytics', 'Data Security Practices', 'IT Infrastructure Management', 
            'Edge Computing', 'API Security', 'Edge Network Computing', 'Cloud-Native Technologies', 
            'Data Backup Strategies', 'Digital Security Infrastructure', 'Smart Devices Management', 
            'Robotic Process Automation (RPA)', 'Geospatial Technologies', 'Cryptocurrency and Blockchain Development', 
            'Remote Server Management', 'Big Data Storage Solutions', 'Data Modeling', 'Software Testing Frameworks', 
            'High Availability Systems', 'Multi-Cloud Environments', 'Server Load Balancing', 'Container Orchestration', 
            'Continuous Monitoring', 'AI in Cybersecurity', 'Virtual Private Network Setup', 'Data Loss Prevention', 
            'AI Chatbots Implementation', 'Microservices Architecture', 'Cloud Data Migration', 
            'High-Performance Computing', 'Disaster Recovery Planning', 'Business Intelligence Tools', 
            'Artificial Intelligence Solutions', 'Cloud Security Architecture', 'IT Disaster Recovery', 
            'Cloud Storage Management', 'Digital Forensics and Incident Response', 'Digital Risk Management', 
            'Tech Solution Design', 'System Integration', 'Technology Innovation', 'Cloud Backup Services', 
            'Data Protection Regulations', 'Data-Driven Decision Making', 'Server Virtualization', 
            'Collaboration Tools Integration', 'Cross-Platform Mobile Development', 'Digital Experience Platforms', 
            'IT Asset Management', 'Artificial Intelligence Analytics', 'Enterprise Resource Planning (ERP)', 
            'Identity and Access Management', 'Mobile Device Management', 'Containerized Applications', 
            'System Automation', 'Big Data Frameworks', 'Cloud-Native Application Development', 
            'AI in IT Management', 'Smart Grid Technologies', 'E-commerce Cloud Solutions', 'SaaS Integration', 
            'Artificial Intelligence Algorithms', 'Machine Learning Models for IT Operations', 
            'Cloud Migration Strategy', 'Private Cloud Infrastructure', 'IT Operations Automation', 
            'Automated Cloud Infrastructure', 'Digital Health Technologies'
        ];
    }
}