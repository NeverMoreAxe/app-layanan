<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Village;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            [
                'code' => '35.05.11',
                'name' => 'Kanigoro',
                'villages' => [
                    ['code' => '35.05.11.1001', 'name' => 'Kanigoro'],
                    ['code' => '35.05.11.1002', 'name' => 'Satreyan'],
                    ['code' => '35.05.11.2003', 'name' => 'Tlogo'],
                    ['code' => '35.05.11.2004', 'name' => 'Gaprang'],
                    ['code' => '35.05.11.2005', 'name' => 'Kuningan'],
                    ['code' => '35.05.11.2006', 'name' => 'Papungan'],
                    ['code' => '35.05.11.2007', 'name' => 'Sawentar'],
                    ['code' => '35.05.11.2008', 'name' => 'Minggirsari'],
                    ['code' => '35.05.11.2009', 'name' => 'Gogodeso'],
                    ['code' => '35.05.11.2010', 'name' => 'Jatinom'],
                ],
            ],
            [
                'code' => '35.05.15',
                'name' => 'Wlingi',
                'villages' => [
                    ['code' => '35.05.15.1001', 'name' => 'Wlingi'],
                    ['code' => '35.05.15.1002', 'name' => 'Beru'],
                    ['code' => '35.05.15.1003', 'name' => 'Babadan'],
                    ['code' => '35.05.15.2004', 'name' => 'Tembalang'],
                    ['code' => '35.05.15.2005', 'name' => 'Tegalasri'],
                    ['code' => '35.05.15.2006', 'name' => 'Ngadirenggo'],
                    ['code' => '35.05.15.2007', 'name' => 'Balerejo'],
                ],
            ],
            [
                'code' => '35.05.08',
                'name' => 'Sutojayan',
                'villages' => [
                    ['code' => '35.05.08.1001', 'name' => 'Kalipang'],
                    ['code' => '35.05.08.1002', 'name' => 'Sutojayan'],
                    ['code' => '35.05.08.1003', 'name' => 'Kembangarum'],
                    ['code' => '35.05.08.1004', 'name' => 'Sukorejo'],
                    ['code' => '35.05.08.2005', 'name' => 'Pandanarum'],
                    ['code' => '35.05.08.2006', 'name' => 'Bacem'],
                    ['code' => '35.05.08.2007', 'name' => 'Kedungbunder'],
                ],
            ],
            [
                'code' => '35.05.12',
                'name' => 'Garum',
                'villages' => [
                    ['code' => '35.05.12.1001', 'name' => 'Garum'],
                    ['code' => '35.05.12.1002', 'name' => 'Tawangsari'],
                    ['code' => '35.05.12.1003', 'name' => 'Bence'],
                    ['code' => '35.05.12.2004', 'name' => 'Slorok'],
                    ['code' => '35.05.12.2005', 'name' => 'Pojok'],
                    ['code' => '35.05.12.2006', 'name' => 'Tingal'],
                    ['code' => '35.05.12.2007', 'name' => 'Karangrejo'],
                    ['code' => '35.05.12.2008', 'name' => 'Sidodadi'],
                ],
            ],
            [
                'code' => '35.05.04',
                'name' => 'Srengat',
                'villages' => [
                    ['code' => '35.05.04.1001', 'name' => 'Srengat'],
                    ['code' => '35.05.04.1002', 'name' => 'Dandong'],
                    ['code' => '35.05.04.1003', 'name' => 'Kauman'],
                    ['code' => '35.05.04.1004', 'name' => 'Togogan'],
                    ['code' => '35.05.04.2005', 'name' => 'Kendalrejo'],
                    ['code' => '35.05.04.2006', 'name' => 'Selokajang'],
                    ['code' => '35.05.04.2007', 'name' => 'Purwokerto'],
                ],
            ],
            [
                'code' => '35.05.05',
                'name' => 'Sanankulon',
                'villages' => [
                    ['code' => '35.05.05.2001', 'name' => 'Sanankulon'],
                    ['code' => '35.05.05.2002', 'name' => 'Bendowulung'],
                    ['code' => '35.05.05.2003', 'name' => 'Kalipucung'],
                    ['code' => '35.05.05.2004', 'name' => 'Sumberjo'],
                    ['code' => '35.05.05.2005', 'name' => 'Plosoarang'],
                    ['code' => '35.05.05.2006', 'name' => 'Purworejo'],
                ],
            ],
            [
                'code' => '35.05.07',
                'name' => 'Kademangan',
                'villages' => [
                    ['code' => '35.05.07.1001', 'name' => 'Kademangan'],
                    ['code' => '35.05.07.2002', 'name' => 'Rejotangan'],
                    ['code' => '35.05.07.2003', 'name' => 'Plumpungrejo'],
                    ['code' => '35.05.07.2004', 'name' => 'Darungan'],
                    ['code' => '35.05.07.2005', 'name' => 'Maron'],
                    ['code' => '35.05.07.2006', 'name' => 'Suruhwadang'],
                ],
            ],
            [
                'code' => '35.05.13',
                'name' => 'Nglegok',
                'villages' => [
                    ['code' => '35.05.13.1001', 'name' => 'Nglegok'],
                    ['code' => '35.05.13.2002', 'name' => 'Modangan'],
                    ['code' => '35.05.13.2003', 'name' => 'Jiwut'],
                    ['code' => '35.05.13.2004', 'name' => 'Kedawung'],
                    ['code' => '35.05.13.2005', 'name' => 'Penataran'],
                    ['code' => '35.05.13.2006', 'name' => 'Sumberasri'],
                ],
            ],
        ];

        foreach ($districts as $dData) {
            $district = District::firstOrCreate(
                ['code' => $dData['code']],
                ['name' => $dData['name']]
            );

            foreach ($dData['villages'] as $vData) {
                Village::firstOrCreate(
                    ['code' => $vData['code']],
                    [
                        'district_id' => $district->id,
                        'name' => $vData['name'],
                    ]
                );
            }
        }
    }
}
