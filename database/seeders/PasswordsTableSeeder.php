<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasswordsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('passwords')->delete();
        
        DB::table('passwords')->insert(array (
            0 => 
            array (
                'id' => 1,
                'password' => '$2y$10$WX.UmViwng8JB/rurvg2p.FTLSTRSW7zNncuZVsahHd2tgvZE9DYC',
                'created_at' => '2024-05-03 00:28:43',
                'updated_at' => '2024-05-03 00:28:43',
            ),
            1 => 
            array (
                'id' => 2,
                'password' => '$2y$10$UBJQV716GyNabNIt9sgI.e73gC1/1afA9GvM4aIUFzVWB53KmBqBu',
                'created_at' => '2024-05-03 00:28:43',
                'updated_at' => '2024-05-03 00:28:43',
            ),
            2 => 
            array (
                'id' => 3,
                'password' => '$2y$10$8eWnYXAWf0AXzBTQyGeiP.nkfsFcgsAyth0Hgwe5FFNs2nlv6RfW.',
                'created_at' => '2024-05-03 00:28:43',
                'updated_at' => '2024-05-03 00:28:43',
            ),
            3 => 
            array (
                'id' => 4,
                'password' => '$2y$10$icztsazpnqEY9amhAZZFl.5Tq54cTihY7H7gE/qGjOPrxkx.5b.fK',
                'created_at' => '2024-05-03 00:28:43',
                'updated_at' => '2024-05-03 00:28:43',
            ),
            4 => 
            array (
                'id' => 5,
                'password' => '$2y$10$5Q2hQ2qJ4dkjFelzY1iONODB/iDgymT5gt8mCCIIeqMQiWckwpEa',
                'created_at' => '2024-05-03 00:28:43',
                'updated_at' => '2024-05-03 00:28:43',
            ),
            5 => 
            array (
                'id' => 6,
                'password' => '$2y$10$PJWgiOCe5HxICgX1sJdj5O63oX1F4xh48eQh2LsMqyFDpjFeAZT0W',
                'created_at' => '2024-05-03 00:28:43',
                'updated_at' => '2024-05-03 00:28:43',
            ),
            6 => 
            array (
                'id' => 7,
                'password' => '$2y$10$tycCo5XRKtjmufG0Cdmae.VdFW0iJU41XN899RJR5ap8uZK7meC42',
                'created_at' => '2024-05-03 00:28:43',
                'updated_at' => '2024-05-03 00:28:43',
            ),
            7 => 
            array (
                'id' => 8,
                'password' => '$2y$10$gM9ieTRAt9aN/RV4cAvYOOEy1KwDzrSEtRULpe845HH9Ghs0bLAnO',
                'created_at' => '2024-05-03 00:28:43',
                'updated_at' => '2024-05-03 00:28:43',
            ),
            8 => 
            array (
                'id' => 9,
                'password' => '$2y$10$fh5C.GdY1BzbS1x9KtAxluJ4R8fIfdlCPW4tEkThOV9WI2gy7vYM2',
                'created_at' => '2024-05-03 00:28:43',
                'updated_at' => '2024-05-03 00:28:43',
            ),
            9 => 
            array (
                'id' => 10,
                'password' => '$2y$10$xmsRSjd5ukvgsNWLX4s6/.2a3oKoN9bmp8q1Cgfk/auaWJIXlKWRC',
                'created_at' => '2024-05-03 00:28:43',
                'updated_at' => '2024-05-03 00:28:43',
            ),
            10 => 
            array (
                'id' => 11,
                'password' => '$2y$10$DpVIwuWCXvCAqdDtmzshkObOjeYOdPnKBUdluwa7dCd.aaWV8PDd.',
                'created_at' => '2024-05-03 00:28:44',
                'updated_at' => '2024-05-03 00:28:44',
            ),
            11 => 
            array (
                'id' => 12,
                'password' => '$2y$10$rscwHQt8mt38GucWU7K6EeOiAGRhBFarPp/hLix4JRC1k2g4upMAe',
                'created_at' => '2024-05-03 00:28:44',
                'updated_at' => '2024-05-03 00:28:44',
            ),
            12 => 
            array (
                'id' => 13,
                'password' => '$2y$10$EJ7/gphkhjXpyS2TTurT0.AVvEtplj0gXAaCAX.CITsy2dTvGZwuG',
                'created_at' => '2024-05-03 00:28:44',
                'updated_at' => '2024-05-03 00:28:44',
            ),
            13 => 
            array (
                'id' => 14,
                'password' => '$2y$10$p4Ntbk4A0SNhxoIE1f0bH.UAGxzP7jBI5g5iDBE107YvJz09yLP.',
                'created_at' => '2024-05-03 00:28:44',
                'updated_at' => '2024-05-03 00:28:44',
            ),
            14 => 
            array (
                'id' => 15,
                'password' => '$2y$10$aRDIHQ9Ijoecrt1O2moqHOOOQTF/0da3Q6dcsoAm0UQiZMITHnFb.',
                'created_at' => '2024-05-03 00:28:44',
                'updated_at' => '2024-05-03 00:28:44',
            ),
            15 => 
            array (
                'id' => 16,
                'password' => '$2y$10$gfJ0dGwDzXT5OCTLg6tTsOWxzQwxakxIPejCHG.6HLBcFD1OSPWbm',
                'created_at' => '2024-05-03 00:28:44',
                'updated_at' => '2024-05-03 00:28:44',
            ),
            16 => 
            array (
                'id' => 17,
                'password' => '$2y$10$xWGa1vIdi0F1QXjzZBhEj.zMlfW4eZaI11Pt6nQr4Votjq5GJczN2',
                'created_at' => '2024-05-03 00:28:45',
                'updated_at' => '2024-05-03 00:28:45',
            ),
            17 => 
            array (
                'id' => 18,
                'password' => '$2y$10$VyOMGq.P8truUsuxcsrQRezX2El01wmxsX9rlT1FCNr2NSnW7P8PK',
                'created_at' => '2024-05-03 00:28:45',
                'updated_at' => '2024-05-03 00:28:45',
            ),
            18 => 
            array (
                'id' => 19,
                'password' => '$2y$10$lzAg9H/ntWjQpQLYDDuSAOrA6Py89XH5QCxyvrmC2tYcJ9zAjfJkm',
                'created_at' => '2024-05-03 00:28:45',
                'updated_at' => '2024-05-03 00:28:45',
            ),
            19 => 
            array (
                'id' => 20,
                'password' => '$2y$10$/3itLkHm4aTGcy5jrtYFgORh.QgjGoAn.IY/qx0RCVGf0WOOkCUfy',
                'created_at' => '2024-05-03 00:28:45',
                'updated_at' => '2024-05-03 00:28:45',
            ),
            20 => 
            array (
                'id' => 21,
                'password' => '$2y$10$i5NKNgZqvQ2dJEk/EM4wQ.CM24qEi6K98ZymZilv6AJ1YfEneeFFm',
                'created_at' => '2024-05-03 00:28:45',
                'updated_at' => '2024-05-03 00:28:45',
            ),
            21 => 
            array (
                'id' => 22,
                'password' => '$2y$10$H.3CyTX16SnzCPSOxwvCbe3EgyzkTzoDifcwJuU/fr6sFmhJ5Ocg6',
                'created_at' => '2024-05-03 00:28:45',
                'updated_at' => '2024-05-03 00:28:45',
            ),
            22 => 
            array (
                'id' => 23,
                'password' => '$2y$10$v9olh4aRf/MEGX5ugTZy1edw.FLyBmz0JHGwmLp4jBVPr9ILK6HMe',
                'created_at' => '2024-05-03 00:28:46',
                'updated_at' => '2024-05-03 00:28:46',
            ),
            23 => 
            array (
                'id' => 24,
                'password' => '$2y$10$64JldDoG6IptkHU7evB74egKK8HirVfbOtlCLMUOAM6MmN/SfPXZ.',
                'created_at' => '2024-05-03 00:28:46',
                'updated_at' => '2024-05-03 00:28:46',
            ),
            24 => 
            array (
                'id' => 25,
                'password' => '$2y$10$sNMj.3CMP8s7ZN9T3Upu0OeyL9ZbVqo0lkvz8C0jh1I2Ni3IXbc62',
                'created_at' => '2024-05-03 00:28:46',
                'updated_at' => '2024-05-03 00:28:46',
            ),
            25 => 
            array (
                'id' => 26,
                'password' => '$2y$10$fQ0Kk6bKQd7lHjynp3Ajmu/rKldfvN0OtfOl.Qoqyq3ZZ0hffA7qG',
                'created_at' => '2024-05-03 00:28:46',
                'updated_at' => '2024-05-03 00:28:46',
            ),
            26 => 
            array (
                'id' => 27,
                'password' => '$2y$10$e7p.vqDzIqfySBePBceALuxgCsJGBDNaTHd4v4.opLwhmjwdK8M/e',
                'created_at' => '2024-05-03 00:28:46',
                'updated_at' => '2024-05-03 00:28:46',
            ),
            27 => 
            array (
                'id' => 28,
                'password' => '$2y$10$c4mAeH4PuGVS.7DKlCgjqeT1cZ2gi1jN6aEyqOAHkCvmeO12l1F2y',
                'created_at' => '2024-05-03 00:28:46',
                'updated_at' => '2024-05-03 00:28:46',
            ),
            28 => 
            array (
                'id' => 29,
                'password' => '$2y$10$EEl4ExlIOEVOzwTYGwL7mut1PSyiktKDYVKnjq8qRUNv1vkQ4Ssg2',
                'created_at' => '2024-05-03 00:28:47',
                'updated_at' => '2024-05-03 00:28:47',
            ),
            29 => 
            array (
                'id' => 30,
                'password' => '$2y$10$hElupvlonYUbWQGqEt5s6ORWk8moVlCxV2leWMdmw0qcyjxgg4.HW',
                'created_at' => '2024-05-03 00:28:47',
                'updated_at' => '2024-05-03 00:28:47',
            ),
            30 => 
            array (
                'id' => 31,
                'password' => '$2y$10$uuBOFVuPcW2rcotfhAiFY.Zv2Imbm7fM5.tcrYbxBYg9/4c9LYSQu',
                'created_at' => '2024-05-03 00:28:47',
                'updated_at' => '2024-05-03 00:28:47',
            ),
            31 => 
            array (
                'id' => 32,
                'password' => '$2y$10$sBAdtUk7MxO.E2MrgnePOuJMeGUUPhH2jdC9rWl33g5XpCtvAy3H6',
                'created_at' => '2024-05-03 00:28:47',
                'updated_at' => '2024-05-03 00:28:47',
            ),
            32 => 
            array (
                'id' => 33,
                'password' => '$2y$10$DQSfvryQ1bLsBF2K67xtleVwwuzju/YSSYZPTCZE0/BKDaFCrK17u',
                'created_at' => '2024-05-03 00:28:47',
                'updated_at' => '2024-05-03 00:28:47',
            ),
            33 => 
            array (
                'id' => 34,
                'password' => '$2y$10$g5cRCfChW.b278l9Ldjzuu4cIUTp/IZHLCRKJ2YxC4AOpi2Ef3UA.',
                'created_at' => '2024-05-03 00:28:48',
                'updated_at' => '2024-05-03 00:28:48',
            ),
            34 => 
            array (
                'id' => 35,
                'password' => '$2y$10$jQJAX7gP4f8xdkUabSCQMehcU.y0JaExS9/P9Ef0Z.f2F847XYiRS',
                'created_at' => '2024-05-03 00:28:48',
                'updated_at' => '2024-05-03 00:28:48',
            ),
            35 => 
            array (
                'id' => 36,
                'password' => '$2y$10$2dyAAhhU4EFuXuMQXfUrbeP1zcap4zMRNVFS56BwUKSnIuJzw/Mkq',
                'created_at' => '2024-05-03 00:28:48',
                'updated_at' => '2024-05-03 00:28:48',
            ),
            36 => 
            array (
                'id' => 37,
                'password' => '$2y$10$VEkaAFZlutCzXfnfs2v6X.Itd2/l2VButr0MWAjKszvHXMTOjlxc2',
                'created_at' => '2024-05-03 00:28:48',
                'updated_at' => '2024-05-03 00:28:48',
            ),
            37 => 
            array (
                'id' => 38,
                'password' => '$2y$10$TV5/Rsym76NK8fnvNObC0OfZ7DR.IvY6aFfyRbDt8CQXiCCZ47vm.',
                'created_at' => '2024-05-03 00:28:48',
                'updated_at' => '2024-05-03 00:28:48',
            ),
            38 => 
            array (
                'id' => 39,
                'password' => '$2y$10$8qG2xT1anSYrf6ppojTdF.LJinD4eQIrkZ.15aGaFZFUjw05vloXa',
                'created_at' => '2024-05-03 00:28:48',
                'updated_at' => '2024-05-03 00:28:48',
            ),
            39 => 
            array (
                'id' => 40,
                'password' => '$2y$10$K8La2FuHfeoLWuP3nHg1kOCp2GH9qUDwjze0ZiDZMyEv3tXvjFXwe',
                'created_at' => '2024-05-03 00:28:49',
                'updated_at' => '2024-05-03 00:28:49',
            ),
            40 => 
            array (
                'id' => 41,
                'password' => '$2y$10$fEXmEmtA8KfS2eriQCJpCuBiAxdr9ypX0ldEZIkUR8OEBV1.in5uO',
                'created_at' => '2024-05-03 00:28:49',
                'updated_at' => '2024-05-03 00:28:49',
            ),
            41 => 
            array (
                'id' => 42,
                'password' => '$2y$10$UraExDaB1fyvFscMfVeKOOGfIYdlgnu3MeJY4TFPJalZC63SdrPrG',
                'created_at' => '2024-05-03 00:28:49',
                'updated_at' => '2024-05-03 00:28:49',
            ),
        ));
        
        
    }
}