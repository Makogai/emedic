<?php

namespace Database\Seeders;

use App\Models\DoctorField;
use App\Models\Drug;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $drugs = [
            [
                'name' => 'Paracetamol',
                'description' => 'Paracetamol (INN) ili acetaminofen (USAN) je u širokoj upotrebi na slobodno kao analgetik (olakšanje bola) i antipiretik (umanjenje groznice). On se često koristi protiv glavobolja i drugih manjih bolova. Paracetamol je glavni sastojak brojnih lekova protiv prehlade i gripa. U kombinaciji sa opioidnim analgeticima, paracetamol se takođe može koristiti za regulaciju jakog bola kao što je postoperacioni bol, i za pružanje palijativne nege kod pacijenata sa uznapredovalim kancerom.[4] Njegovo analgetičko dejstvo počinje otprilike 11 minuta nakon oralne administracije,[5] a njegov poluživot je 1–4 sata.',
                'weight' => '500',
            ],
            [
                'name' => 'Aspirin',
                'description' => 'Aspirin® ili acetilsalicilna kiselina salicilatni je lijek koji se često koristi kao analgetik, antipiretik i antiupalni lijek (nesteroidni antireumatik).[1] Također, ima svojstvo antiplateleta, odnosno sprječava nastanak tromboze. Ponekad se koristi u manjim dozama za sprječavanje infarkta srca kod osoba koje imaju rizik od nastajanja tromba.',
                'weight' => '81',
            ],
            [
                'name' => 'Ibuprofen',
                'description' => 'Ibuprofen (INN) ili ibuprofen (USAN) je nesteroidni protuupalni lijek (NSAID) koji se koristi za ublažavanje bolova i smanjenje upale. Ibuprofen je u širokoj upotrebi kao analgetik (olakšanje bola) i antipiretik (umanjenje groznice). On se često koristi protiv glavobolja i drugih manjih bolova. Ibuprofen je glavni sastojak brojnih lekova protiv prehlade i gripa. U kombinaciji sa opioidnim analgeticima, ibuprofen se takođe može koristiti za regulaciju jakog bola kao što je postoperacioni bol, i za pružanje palijativne nege kod pacijenata sa uznapredovalim kancerom.[4] Njegovo analgetičko dejstvo počinje otprilike 11 minuta nakon oralne administracije,[5] a njegov poluživot je 1–4 sata.',
                'weight' => '400',
            ],
            [
                'name' => 'Naproxen',
                'description' => 'Naproxen (INN) ili naproksen (USAN) je nesteroidni protuupalni lijek (NSAID) koji se koristi za ublažavanje bolova i smanjenje upale. Naproxen je u širokoj upotrebi kao analgetik (olakšanje bola) i antipiretik (umanjenje groznice). On se često koristi protiv glavobolja i drugih manjih bolova. Naproxen je glavni sastojak brojnih lekova protiv prehlade i gripa. U kombinaciji sa opioidnim analgeticima, naproxen se takođe može koristiti za regulaciju jakog bola kao što je postoperacioni bol, i za pružanje palijativne nege kod pacijenata sa uznap',
                'weight' => '250',
            ],
            [
                'name' => 'Diclofenac',
                'description' => 'Diclofenac (INN) ili diklofenak (USAN) je nesteroidni protuupalni lijek (NSAID) koji se koristi za ublažavanje bolova i smanjenje upale. Diclofenac je u širokoj upotrebi kao analgetik (olakšanje bola) i antipiretik (umanjenje groznice). On se često koristi protiv glavobolja i drugih manjih bolova. Diclofenac je glavni sastojak brojnih lekova protiv prehlade i gripa. U kombinaciji sa opioidnim analgeticima, diclofenac se takođe može koristiti za regulaciju jakog bola kao što je postoperacioni bol, i za pružanje palijativne nege kod pacijenata sa uznapredovalim kancerom.[4] Njegovo analgetičko dejstvo počinje otprilike 11 minuta nakon oralne administracije,[5] a njegov poluživot je 1–4 sata.',
                'weight' => '100',
            ],
            [
                'name' => 'Ketoprofen',
                'description' => 'Ketoprofen (INN) ili ketoprofen (USAN) je nesteroidni protuupalni lijek (NSAID) koji se koristi za ublažavanje bolova i smanjenje upale. Ketoprofen je u širokoj upotrebi kao analgetik (olakšanje bola) i antipiretik (umanjenje groznice). On se često koristi protiv glavobolja i drugih manjih bolova. Ketoprofen je glavni sastojak brojnih lekova protiv prehlade i gripa. U kombinaciji sa opioidnim analgeticima, ketoprofen se takođe može koristiti za regulaciju jakog bola kao što je postoperacioni bol, i za pružanje palijativne nege kod pac',
                'weight' => '100',
            ],
        ];

        $medicineFields =[
          [
              'name' => 'Kardiologija',
              'title' => 'Kardiolog',
          ],
            [
                'name' => 'Dermatologija',
                'title' => 'Dermatolog',
            ],
            [
                'name' => 'Gastroenterologija',
                'title' => 'Gastroenterolog',
            ],
            [
                'name' => 'Hematologija',
                'title' => 'Hematolog',
            ],
            [
                'name' => 'Hirurgija',
                'title' => 'Hirurg',
            ],
            [
                'name' => 'Imunologija',
                'title' => 'Imunolog',
            ],
            [
                'name' => 'Ofthalmologija',
                'title' => 'Ofthalmolog',
            ],
            [
                'name' => 'Otorinolaringologija',
                'title' => 'Otorinolaringolog',
            ],
            [
                'name' => 'Pedijatrija',
                'title' => 'Pedijatar',
            ],
            [
                'name' => 'Pneumologija',
                'title' => 'Pneumolog',
            ],
            [
                'name' => 'Urologija',
                'title' => 'Urolog',
            ],
            [
                'name' => 'Ortopedija',
                'title' => 'Ortoped',
            ],
            [
                'name' => 'Neurologija',
                'title' => 'Neurolog',
            ]
        ];

        foreach ($drugs as $medicine) {
            Drug::create($medicine);
        }

        foreach ($medicineFields as $medicineField) {
            DoctorField::create($medicineField);
        }


    }
}
