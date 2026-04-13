<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default Admin User
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@bookago.com',
        ]);

        // Real Indonesian book categories
        $categories = collect([
            ['name' => 'Fiksi', 'slug' => 'fiksi', 'color' => '#3B82F6'],
            ['name' => 'Sastra', 'slug' => 'sastra', 'color' => '#8B5CF6'],
            ['name' => 'Romance', 'slug' => 'romance', 'color' => '#EC4899'],
            ['name' => 'Thriller', 'slug' => 'thriller', 'color' => '#EF4444'],
            ['name' => 'Sejarah', 'slug' => 'sejarah', 'color' => '#F59E0B'],
            ['name' => 'Sains', 'slug' => 'sains', 'color' => '#10B981'],
            ['name' => 'Fantasi', 'slug' => 'fantasi', 'color' => '#6366F1'],
            ['name' => 'Self-Help', 'slug' => 'self-help', 'color' => '#14B8A6'],
        ])->map(fn($cat) => Category::create($cat));

        // Real Indonesian books with Google Books thumbnail covers (reliable CDN)
        $books = [
            [
                'title' => 'Bumi',
                'author' => 'Tere Liye',
                'description' => 'Bumi adalah novel pertama dari serial Bumi karya Tere Liye. Cerita tentang Raib, gadis SMP yang memiliki kekuatan misterius.',
                'isbn' => '9786020332451',
                'cover_image' => 'https://books.google.com/books/content?id=2mhDDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 156,
                'categories' => ['Fiksi', 'Fantasi'],
            ],
            [
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'description' => 'Kisah inspiratif sepuluh anak dari Belitung yang berjuang mengejar pendidikan di tengah keterbatasan.',
                'isbn' => '9789793062792',
                'cover_image' => 'https://books.google.com/books/content?id=a_slDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 243,
                'categories' => ['Fiksi', 'Sastra'],
            ],
            [
                'title' => 'Dilan: Dia Adalah Dilanku Tahun 1990',
                'author' => 'Pidi Baiq',
                'description' => 'Kisah cinta romantis yang terjadi di Bandung pada tahun 1990 antara Dilan dan Milea.',
                'isbn' => '9786027870505',
                'cover_image' => 'https://books.google.com/books/content?id=bKZADwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 198,
                'categories' => ['Romance', 'Fiksi'],
            ],
            [
                'title' => 'Negeri 5 Menara',
                'author' => 'Ahmad Fuadi',
                'description' => 'Kisah enam santri dari berbagai daerah di Indonesia yang bermimpi besar di pesantren Madani.',
                'isbn' => '9789799105004',
                'cover_image' => 'https://books.google.com/books/content?id=tvwjEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 134,
                'categories' => ['Fiksi', 'Sastra'],
            ],
            [
                'title' => 'Ayat-Ayat Cinta',
                'author' => 'Habiburrahman El Shirazy',
                'description' => 'Novel tentang perjuangan cinta dan iman seorang mahasiswa Indonesia di Mesir.',
                'isbn' => '9789793062822',
                'cover_image' => 'https://books.google.com/books/content?id=M3VtswEACAAJ&printsec=frontcover&img=1&zoom=1',
                'borrows' => 187,
                'categories' => ['Romance', 'Sastra'],
            ],
            [
                'title' => 'Supernova: Ksatria, Puteri, dan Bintang Jatuh',
                'author' => 'Dee Lestari',
                'description' => 'Novel pertama dari seri Supernova yang memadukan sains, spiritualitas, dan cinta.',
                'isbn' => '9789799731227',
                'cover_image' => 'https://books.google.com/books/content?id=Zr7PEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 165,
                'categories' => ['Fiksi', 'Sains'],
            ],
            [
                'title' => 'Perahu Kertas',
                'author' => 'Dee Lestari',
                'description' => 'Kisah tentang Kugy yang bermimpi menjadi penulis dongeng dan Keenan yang bercita-cita menjadi pelukis.',
                'isbn' => '9789792233001',
                'cover_image' => 'https://books.google.com/books/content?id=THTNDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 142,
                'categories' => ['Romance', 'Fiksi'],
            ],
            [
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'description' => 'Novel pertama dari Tetralogi Buru, menceritakan perjuangan Minke di era kolonial Belanda.',
                'isbn' => '9789799731012',
                'cover_image' => 'https://books.google.com/books/content?id=_PE_DwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 278,
                'categories' => ['Sastra', 'Sejarah'],
            ],
            [
                'title' => 'Anak Semua Bangsa',
                'author' => 'Pramoedya Ananta Toer',
                'description' => 'Novel kedua dari Tetralogi Buru, melanjutkan perjalanan Minke dalam melawan ketidakadilan.',
                'isbn' => '9789799731029',
                'cover_image' => 'https://books.google.com/books/content?id=MlNFDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 189,
                'categories' => ['Sastra', 'Sejarah'],
            ],
            [
                'title' => 'Ronggeng Dukuh Paruk',
                'author' => 'Ahmad Tohari',
                'description' => 'Kisah Srintil, seorang gadis yang menjadi ronggeng di sebuah dukuh terpencil.',
                'isbn' => '9789790810273',
                'cover_image' => 'https://books.google.com/books/content?id=wc4EEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 112,
                'categories' => ['Sastra', 'Fiksi'],
            ],
            [
                'title' => 'Hujan',
                'author' => 'Tere Liye',
                'description' => 'Novel tentang kisah cinta Lail dan Esok di tengah bencana alam yang melanda negeri.',
                'isbn' => '9786020386195',
                'cover_image' => 'https://books.google.com/books/content?id=clsuDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 127,
                'categories' => ['Fiksi', 'Fantasi'],
            ],
            [
                'title' => 'Bulan',
                'author' => 'Tere Liye',
                'description' => 'Kelanjutan serial Bumi yang mengisahkan petualangan Raib, Seli, dan Ali di dunia paralel.',
                'isbn' => '9786020385204',
                'cover_image' => 'https://books.google.com/books/content?id=RjcuDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 138,
                'categories' => ['Fiksi', 'Fantasi'],
            ],
            [
                'title' => 'Filosofi Teras',
                'author' => 'Henry Manampiring',
                'description' => 'Buku tentang filsafat Stoa yang dikemas dengan gaya bahasa ringan dan relevan untuk kehidupan modern.',
                'isbn' => '9786024525682',
                'cover_image' => 'https://books.google.com/books/content?id=22-1DwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 201,
                'categories' => ['Self-Help', 'Sains'],
            ],
            [
                'title' => 'Sang Pemimpi',
                'author' => 'Andrea Hirata',
                'description' => 'Sekuel Laskar Pelangi yang menceritakan perjuangan Ikal, Arai, dan Jimbron meraih mimpi.',
                'isbn' => '9789793062808',
                'cover_image' => 'https://books.google.com/books/content?id=1i8mEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 156,
                'categories' => ['Fiksi', 'Sastra'],
            ],
            [
                'title' => 'Pulang',
                'author' => 'Tere Liye',
                'description' => 'Novel tentang Bujang yang kembali ke kampung halamannya dan menghadapi masa lalu yang kelam.',
                'isbn' => '9786020331584',
                'cover_image' => 'https://books.google.com/books/content?id=lpsuDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 119,
                'categories' => ['Fiksi', 'Thriller'],
            ],
            [
                'title' => 'Cantik Itu Luka',
                'author' => 'Eka Kurniawan',
                'description' => 'Novel yang mengisahkan kehidupan Dewi Ayu, seorang pelacur cantik di sebuah kota kecil.',
                'isbn' => '9789792232790',
                'cover_image' => 'https://books.google.com/books/content?id=Zr_NEwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 145,
                'categories' => ['Sastra', 'Sejarah'],
            ],
            [
                'title' => 'Laut Bercerita',
                'author' => 'Leila S. Chudori',
                'description' => 'Novel tentang aktivis mahasiswa yang hilang selama masa Orde Baru.',
                'isbn' => '9786024246945',
                'cover_image' => 'https://books.google.com/books/content?id=9bxzDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 167,
                'categories' => ['Sastra', 'Sejarah'],
            ],
            [
                'title' => 'Matahari',
                'author' => 'Tere Liye',
                'description' => 'Buku ketiga dari serial Bumi yang melanjutkan petualangan Raib dan teman-temannya.',
                'isbn' => '9786020388427',
                'cover_image' => 'https://books.google.com/books/content?id=Aa1UDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 131,
                'categories' => ['Fiksi', 'Fantasi'],
            ],
            [
                'title' => 'Tentang Kamu',
                'author' => 'Tere Liye',
                'description' => 'Novel tentang Sri Ningsih, seorang yatim piatu yang menjalani kehidupan penuh liku.',
                'isbn' => '9786020348773',
                'cover_image' => 'https://books.google.com/books/content?id=UDcuDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 114,
                'categories' => ['Fiksi', 'Romance'],
            ],
            [
                'title' => 'Sapiens: Riwayat Singkat Umat Manusia',
                'author' => 'Yuval Noah Harari',
                'description' => 'Buku yang menceritakan sejarah umat manusia dari zaman purba hingga era modern. Edisi terjemahan Indonesia.',
                'isbn' => '9786024246204',
                'cover_image' => 'https://books.google.com/books/content?id=FmyBAwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl',
                'borrows' => 223,
                'categories' => ['Sains', 'Sejarah'],
            ],
        ];

        foreach ($books as $bookData) {
            $catNames = $bookData['categories'];
            unset($bookData['categories']);

            $bookData['slug'] = Str::slug($bookData['title']);

            $book = Book::create($bookData);

            // Attach categories
            $catIds = $categories->filter(fn($c) => in_array($c->name, $catNames))->pluck('id');
            $book->categories()->attach($catIds);
        }
    }
}
