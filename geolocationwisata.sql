-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2023 at 10:34 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `geolocationwisata`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `ID_AKUN` varchar(30) NOT NULL,
  `ID_TOKEN` varchar(100) DEFAULT NULL,
  `USERNAME` varchar(15) DEFAULT NULL,
  `PASSWORD` varchar(10) DEFAULT NULL,
  `AUTHORIZATION` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`ID_AKUN`, `ID_TOKEN`, `USERNAME`, `PASSWORD`, `AUTHORIZATION`) VALUES
('ACC2', NULL, 'Account2', 'Account2', 'User'),
('ACC3', NULL, 'Account3', 'Account3', 'User'),
('ACC4', NULL, 'Account4', 'Account4', 'User'),
('ACC5', NULL, 'Account5', 'Account5', 'User'),
('ADM', NULL, 'admin', 'admin', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `buka_tutup_wisata`
--

CREATE TABLE `buka_tutup_wisata` (
  `KODE_JAM_OPERASI` varchar(20) NOT NULL,
  `JAM_OPERASIONAL` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buka_tutup_wisata`
--

INSERT INTO `buka_tutup_wisata` (`KODE_JAM_OPERASI`, `JAM_OPERASIONAL`) VALUES
('1M', '08.00 - 17.00'),
('1M2J', '06.00 - 18.00'),
('6H1D', '08.00 - 02.00 & 07.00 - 18.00');

-- --------------------------------------------------------

--
-- Table structure for table `desa`
--

CREATE TABLE `desa` (
  `ID_DESA` varchar(30) NOT NULL,
  `NAMA_DESA` varchar(50) DEFAULT NULL,
  `KODE_POS` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `desa`
--

INSERT INTO `desa` (`ID_DESA`, `NAMA_DESA`, `KODE_POS`) VALUES
('3523010001', 'SOKOGUNUNG', '62363'),
('3523010002', 'JAMPRONG', '62363'),
('3523010003', 'BENDONGLATENG', '62363'),
('3523010004', 'SIDOREJO', '62363'),
('3523010005', 'SOKOGRENJENG', '62363'),
('3523010006', 'SIDOHASRI', '62363'),
('3523010007', 'SIDOMUKTI', '62363'),
('3523010008', 'TAWARAN', '62363'),
('3523010009', 'JLODRO', '62363'),
('3523020001', 'KLAKEH', '62364'),
('3523020002', 'BATE', '62364'),
('3523020003', 'KABLUKAN', '62364'),
('3523020004', 'NGROJO', '62364'),
('3523020006', 'SIDOKUMPUL', '62364'),
('3523020007', 'SIDOTENTREM', '62364'),
('3523020008', 'BANGILAN', '62364'),
('3523020009', 'KEDUNGHARDJO', '62364'),
('3523020010', 'KEDUNGMULYO', '62364'),
('3523020011', 'BANJARWORO', '62364'),
('3523020012', 'SIDODADI', '62364'),
('3523020013', 'KEDUNGJAMBANGAN', '62364'),
('3523020014', 'KUMPULREJO', '62364'),
('3523030001', 'BANYUURIP', '62365'),
('3523030002', 'WONOSARI', '62365'),
('3523030003', 'KATERBAN', '62365'),
('3523030004', 'RAYUNG', '62365'),
('3523030005', 'SIDOHARJO', '62365'),
('3523030006', 'WANGLU WETAN', '62365'),
('3523030007', 'WANGLU KULON', '62365'),
('3523030008', 'LERAN', '62365'),
('3523030009', 'KALIGEDE', '62365'),
('3523030010', 'JATISARI', '62365'),
('3523030011', 'MEDALEM', '62365'),
('3523030012', 'SENDANG', '62365'),
('3523040001', 'BINANGUN', '62361'),
('3523040002', 'SARINGEMBAT', '62361'),
('3523040003', 'KEDUNGJAMBE', '62361'),
('3523040004', 'TUNGGULREJO', '62361'),
('3523040005', 'TANJUNGREJO', '62361'),
('3523040006', 'LAJO KIDUL', '62361'),
('3523040007', 'TANGGIR', '62361'),
('3523040008', 'MERGOSARI', '62361'),
('3523040009', 'MULYOREJO', '62361'),
('3523040010', 'TINGKIS', '62361'),
('3523040011', 'MULYOAGUNG', '62361'),
('3523040012', 'LAJO LOR', '62361'),
('3523050001', 'MANJUNG', '62357'),
('3523050002', 'TANGGULANGIN', '62357'),
('3523050004', 'BRINGIN', '62357'),
('3523050005', 'MAINDU', '62357'),
('3523050006', 'JETAK', '62357'),
('3523050007', 'TALUN', '62357'),
('3523050008', 'PUCANGAN', '62357'),
('3523050009', 'PAKEL', '62357'),
('3523050010', 'MONTONGSEKAR', '62357'),
('3523050011', 'TALANGKEMBAR', '62357'),
('3523050012', 'NGULUHAN', '62357'),
('3523050013', 'GUWOTERUS', '62357'),
('3523060001', 'KEMLATEN', '62366'),
('3523060002', 'MERGOASRI', '62366'),
('3523060003', 'KUMPULREJO', '62366'),
('3523060004', 'CENGKONG', '62366'),
('3523060005', 'BRANGKAL', '62366'),
('3523060006', 'MERGOREJO', '62366'),
('3523060007', 'SELOGABUS', '62366'),
('3523060008', 'SENDANGREJO', '62366'),
('3523060009', 'MOJOMALANG', '62366'),
('3523060010', 'SUGIHWARAS', '62366'),
('3523060011', 'SUCIHARJO', '62366'),
('3523060012', 'PACING', '62366'),
('3523060013', 'PARANGBATU', '62366'),
('3523060014', 'SUKOREJO', '62366'),
('3523060016', 'NGAWUN', '62366'),
('3523060017', 'WUKIRHARJO', '62366'),
('3523060018', 'DAGANGAN', '62366'),
('3523070001', 'MENILO', '62372'),
('3523070002', 'SIMO', '62372'),
('3523070003', 'KENDALREJO', '62372'),
('3523070004', 'MOJOAGUNG', '62372'),
('3523070005', 'PANDANWANGI', '62372'),
('3523070006', 'GLAGAHSARI', '62372'),
('3523070007', 'KENONGOSARI', '62372'),
('3523070008', 'SANDINGROWO', '62372'),
('3523070009', 'RAHAYU', '62372'),
('3523070010', 'SOKOSARI', '62372'),
('3523070011', 'BANGUNREJO', '62372'),
('3523070012', 'MENTORO', '62372'),
('3523070013', 'PANDANAGUNG', '62372'),
('3523070014', 'PRAMBONTERGAYANG', '62372'),
('3523070015', 'JATI', '62372'),
('3523070016', 'CEKALANG', '62372'),
('3523070018', 'WADUNG', '62372'),
('3523070019', 'KLUMPIT', '62372'),
('3523070020', 'JEGULO', '62372'),
('3523070021', 'SUMURCINDE', '62372'),
('3523070022', 'NGURUAN', '62372'),
('3523070023', 'GUNUNGANYAR', '62372'),
('3523080001', 'KEBONAGUNG', '62370'),
('3523080002', 'BULUREJO', '62370'),
('3523080003', 'KARANGTINOTO', '62370'),
('3523080004', 'TAMBAKREJO', '62370'),
('3523080005', 'KANOREJO', '62370'),
('3523080006', 'NGADIREJO', '62370'),
('3523080007', 'SUMBEREJO', '62370'),
('3523080008', 'CAMPUREJO', '62370'),
('3523080009', 'BANJARARUM', '62370'),
('3523080010', 'PRAMBON WETAN', '62370'),
('3523080011', 'BANJARAGUNG', '62370'),
('3523080012', 'PUNGGULREJO', '62370'),
('3523080016', 'SAWAHAN', '62370'),
('3523080017', 'MAIBIT', '62370'),
('3523080018', 'PEKUWON', '62370'),
('3523081001', 'NGARUM', '62371'),
('3523081003', 'BANYUBANG', '62371'),
('3523081004', 'GRABAGAN', '62371'),
('3523081005', 'WALERAN', '62371'),
('3523081006', 'GESIKAN', '62371'),
('3523081007', 'NGANDONG', '62371'),
('3523081008', 'DAHOR', '62371'),
('3523081009', 'DERMAWUHARDJO', '62371'),
('3523081011', 'PAKIS', '62371'),
('3523090002', 'KESAMBEN', '62382'),
('3523090003', 'KEPOHAGUNG', '62382'),
('3523090004', 'KEDUNGROJO', '62382'),
('3523090005', 'CANGKRING', '62382'),
('3523090006', 'SEMBUNGREJO', '62382'),
('3523090007', 'PLANDIREJO', '62382'),
('3523090008', 'BANDUNGREJO', '62382'),
('3523090009', 'KLOTOK', '62382'),
('3523090010', 'KEBOMLATI', '62382'),
('3523090011', 'KEDUNGSOKO', '62382'),
('3523090012', 'PENIDON', '62382'),
('3523090013', 'MAGERSARI', '62382'),
('3523090014', 'JATIMULYO', '62382'),
('3523090015', 'PLUMPANG', '62382'),
('3523090016', 'SUMURJALAK', '62382'),
('3523090017', 'NGRAYUNG', '62382'),
('3523090018', 'SUMBERAGUNG', '62382'),
('3523100001', 'PATIHAN', '62383'),
('3523100002', 'NGADIPURO', '62383'),
('3523100003', 'NGADIREJO', '62383'),
('3523100005', 'WIDANG', '62383'),
('3523100006', 'COMPRENG', '62383'),
('3523100007', 'BANJAR', '62383'),
('3523100008', 'TEGALSARI', '62383'),
('3523100009', 'KEDUNGHARJO', '62383'),
('3523100010', 'TEGALREJO', '62383'),
('3523100011', 'SIMOREJO', '62383'),
('3523100013', 'MINOHOREJO', '62383'),
('3523100014', 'SUMBEREJO', '62383'),
('3523100015', 'MLANGI', '62383'),
('3523110001', 'NGIMBANG', '62391'),
('3523110002', 'WANGUN', '62391'),
('3523110003', 'KETAMBUL', '62391'),
('3523110004', 'CEPOKOREJO', '62391'),
('3523110005', 'PLIWETAN', '62391'),
('3523110006', 'KARANGAGUNG', '62391'),
('3523110007', 'LERAN WETAN', '62391'),
('3523110008', 'LERAN KULON', '62391'),
('3523110009', 'GLODOG', '62391'),
('3523110010', 'PALANG', '62391'),
('3523110011', 'GESIKHARJO', '62391'),
('3523110012', 'PUCANGAN', '62391'),
('3523110013', 'CENDORO', '62391'),
('3523110014', 'DAWUNG', '62391'),
('3523110015', 'TEGALBANG', '62391'),
('3523110017', 'KRADENAN', '62391'),
('3523110018', 'TASIKMADU', '62391'),
('3523110019', 'PANYURAN', '62391'),
('3523120003', 'NGINO', '62381'),
('3523120005', 'BEKTIHARJO', '62381'),
('3523120006', 'SAMBONGREJO', '62381'),
('3523120007', 'GENAHARJO', '62381'),
('3523120008', 'GESING', '62381'),
('3523120009', 'TUNAH', '62381'),
('3523120010', 'KOWANG', '62381'),
('3523120011', 'PENAMBANGAN', '62381'),
('3523120012', 'SEMANDING', '62381'),
('3523120013', 'PRUNGGAHAN WETAN', '62381'),
('3523120014', 'PRUNGGAHAN KULON', '62381'),
('3523120015', 'JADI', '62381'),
('3523120016', 'BOTO', '62381'),
('3523120017', 'TEGALAGUNG', '62381'),
('3523120018', 'BEJAGUNG', '62381'),
('3523120019', 'GEDONGOMBO', '62381'),
('3523120020', 'KARANG', '62381'),
('3523130002', 'SUGIHARJO', '62311'),
('3523130003', 'KEMBANGBILO', '62311'),
('3523130004', 'MONDOKAN', '62311'),
('3523130005', 'PERBON', '62311'),
('3523130006', 'LATSARI', '62311'),
('3523130007', 'SIDOREJO', '62311'),
('3523130008', 'DOROMUKTI', '62311'),
('3523130009', 'KEBONSARI', '62311'),
('3523130010', 'SUKOLILO', '62311'),
('3523130011', 'BATURETNO', '62311'),
('3523130012', 'SENDANGHARJO', '62311'),
('3523130013', 'KUTOREJO', '62311'),
('3523130014', 'SIDOMULYO', '62311'),
('3523130015', 'RONGGOMULYO', '62311'),
('3523130016', 'KINGKING', '62311'),
('3523130017', 'KARANGSARI', '62311'),
('3523140001', 'KARANGASEM', '62352'),
('3523140002', 'SOCOREJO', '62352'),
('3523140003', 'TEMAJI', '62352'),
('3523140004', 'PURWOREJO', '62352'),
('3523140005', 'TASIKHARJO', '62352'),
('3523140007', 'MENTOSO', '62352'),
('3523140008', 'RAWASAN', '62352'),
('3523140010', 'WADUNG', '62352'),
('3523140011', 'KALIUNTU', '62352'),
('3523140012', 'BEJI', '62352'),
('3523140013', 'SUWALAN', '62352'),
('3523140014', 'JENGGOLO', '62352'),
('3523140015', 'SEKARDADI', '62352'),
('3523140017', 'SUGIHWARAS', '62352'),
('3523150001', 'KAPU', '62355'),
('3523150002', 'TEGALREJO', '62355'),
('3523150003', 'TAHULU', '62355'),
('3523150004', 'MANDIREJO', '62355'),
('3523150005', 'BOGOREJO', '62355'),
('3523150006', 'SUMBEREJO', '62355'),
('3523150007', 'SENDANGHAJI', '62355'),
('3523150008', 'SAMBONGGEDE', '62355'),
('3523150010', 'TUWIRI WETAN', '62355'),
('3523150011', 'TUWIRI KULON', '62355'),
('3523150012', 'BOREHBANGLE', '62355'),
('3523150013', 'SENORI', '62355'),
('3523150014', 'SEMBUNGREJO', '62355'),
('3523150015', 'PONGPONGAN', '62355'),
('3523150016', 'TEMANDANG', '62355'),
('3523150017', 'TLOGOWARU', '62355'),
('3523150018', 'TOBO', '62355'),
('3523150019', 'SUGIHAN', '62355'),
('3523160002', 'WOLUTENGAH', '62356'),
('3523160003', 'TRANTANG', '62356'),
('3523160004', 'SIDONGANTI', '62356'),
('3523160005', 'TENGGER WETAN', '62356'),
('3523160006', 'HARGORETNO', '62356'),
('3523160007', 'TEMAYANG', '62356'),
('3523160008', 'PADASAN', '62356'),
('3523160009', 'KARANGLO', '62356'),
('3523160010', 'SUMBERARUM', '62356'),
('3523160011', 'MARGOMULYO', '62356'),
('3523160012', 'JAROREJO', '62356'),
('3523160013', 'MARGOREJO', '62356'),
('3523160014', 'GAJI', '62356'),
('3523160015', 'KEDUNGREJO', '62356'),
('3523160016', 'KASIMAN', '62356'),
('3523160017', 'MLIWANG', '62356'),
('3523170001', 'NGULAHAN', '62353'),
('3523170002', 'DIKIR', '62353'),
('3523170003', 'MANDER', '62353'),
('3523170004', 'PLAJAN', '62353'),
('3523170005', 'BELIKANGET', '62353'),
('3523170006', 'COKROWATI', '62353'),
('3523170007', 'SOTANG', '62353'),
('3523170008', 'PULOGEDE', '62353'),
('3523170009', 'GADON', '62353'),
('3523170010', 'PABEYAN', '62353'),
('3523170011', 'TAMBAKBOYO', '62353'),
('3523170013', 'DASIN', '62353'),
('3523170014', 'KENANTI', '62353'),
('3523170015', 'SOBONTORO', '62353'),
('3523170016', 'SAWIR', '62353'),
('3523170017', 'MERKAWANG', '62353'),
('3523170018', 'GLONDONGGEDE', '62353'),
('3523180001', 'KARANGTENGAH', '62362'),
('3523180002', 'JOMBOK', '62362'),
('3523180003', 'WOTSOGO', '62362'),
('3523180004', 'SIDOMULYO', '62362'),
('3523180005', 'JATIKLABANG', '62362'),
('3523180006', 'DINGIL', '62362'),
('3523180007', 'DEMIT', '62362'),
('3523180008', 'SUGIHAN', '62362'),
('3523180009', 'SADANG', '62362'),
('3523180010', 'BADER', '62362'),
('3523180011', 'PASEYAN', '62362'),
('3523180012', 'KEBONHARJO', '62362'),
('3523180013', 'WANGI', '62362'),
('3523180014', 'KETODAN', '62362'),
('3523180015', 'BESOWO', '62362'),
('3523180016', 'NGEPON', '62362'),
('3523180017', 'KEDUNGMAKAM', '62362'),
('3523180018', 'SEKARAN', '62362'),
('3523190001', 'JATISARI', '62354'),
('3523190002', 'KAYEN', '62354'),
('3523190003', 'SUKOHARJO', '62354'),
('3523190004', 'SIDOMULYO', '62354'),
('3523190005', 'CINGKLUNG', '62354'),
('3523190006', 'MARGOSUKO', '62354'),
('3523190007', 'NGAMPELREJO', '62354'),
('3523190008', 'PUGOH', '62354'),
('3523190009', 'KARANGREJO', '62354'),
('3523190010', 'SUMBERAN', '62354'),
('3523190011', 'SIDING', '62354'),
('3523190012', 'TENGGER KULON', '62354'),
('3523190013', 'NGUJURAN', '62354'),
('3523190014', 'TLOGOAGUNG', '62354'),
('3523190015', 'LATSARI', '62354'),
('3523190016', 'SUKOLILO', '62354'),
('3523190017', 'BULUJOWO', '62354'),
('3523190018', 'BULUMEDURO', '62354'),
('3523190019', 'BANJAREJO', '62354'),
('3523190020', 'TERGAMBANG', '62354'),
('3523190021', 'SEMBUNGIN', '62354'),
('3523190022', 'BONCONG', '62354'),
('3523190023', 'BOGOREJO', '62354'),
('3523190024', 'BANCAR', '62354');

-- --------------------------------------------------------

--
-- Table structure for table `gps`
--

CREATE TABLE `gps` (
  `KODE` varchar(15) NOT NULL,
  `ID` varchar(25) NOT NULL,
  `KODE_POS` decimal(10,0) DEFAULT NULL,
  `LONGITUDE` double(20,15) DEFAULT NULL,
  `ALTITUDE` double(20,15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hari_operasional_wisata`
--

CREATE TABLE `hari_operasional_wisata` (
  `ID_OPERASIONAL` varchar(25) NOT NULL,
  `KODE_POS` decimal(10,0) DEFAULT NULL,
  `KODE_UPLOADER` varchar(50) NOT NULL,
  `ID` varchar(25) NOT NULL,
  `KODE_JAM_OPERASI` varchar(20) NOT NULL,
  `HARI_OPERASIONAL` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `KODE_POS` decimal(10,0) NOT NULL,
  `KECAMATAN` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`KODE_POS`, `KECAMATAN`) VALUES
('62311', 'Tuban'),
('62352', 'Jenu'),
('62353', 'Tambakboyo'),
('62354', 'Bancar'),
('62355', 'Merakurak'),
('62356', 'Kerek'),
('62357', 'Montong'),
('62361', 'Singgahan'),
('62362', 'Jatirogo'),
('62363', 'Kenduruhan'),
('62364', 'Bangilan'),
('62365', 'Senori'),
('62366', 'Parengan'),
('62370', 'Rengel'),
('62371', 'Grabagan'),
('62372', 'Soko'),
('62381', 'Semanding'),
('62382', 'Plumpang'),
('62383', 'Widang'),
('62391', 'Palang');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(3, '2023-03-28-012509', 'App\\Database\\Migrations\\UserToken', 'default', 'App', 1679975719, 1),
(4, '2023-03-28-025457', 'App\\Database\\Migrations\\UserLogin', 'default', 'App', 1679975719, 1);

-- --------------------------------------------------------

--
-- Table structure for table `profil_wisata`
--

CREATE TABLE `profil_wisata` (
  `ID` varchar(25) NOT NULL,
  `NAMA` varchar(50) DEFAULT NULL,
  `VIDEO` char(50) DEFAULT NULL,
  `DESKRIPSI_TEXT` longtext DEFAULT NULL,
  `GAMBAR` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `ID_TOKEN` varchar(100) NOT NULL,
  `ACCESS_TOKEN` longtext DEFAULT NULL,
  `REFRESH_TOKEN` longtext DEFAULT NULL,
  `EXPIRES_IN` varchar(30) DEFAULT NULL,
  `LOGIN_TYPE` enum('Google','Instagram','Facebook') NOT NULL,
  `ID_AKUN` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`ID_TOKEN`, `ACCESS_TOKEN`, `REFRESH_TOKEN`, `EXPIRES_IN`, `LOGIN_TYPE`, `ID_AKUN`) VALUES
('FB-1460833691344795', 'EAAKajIPevYoBO96nQBo0FiA28e2JbEOfiZBqJJrtgLVgwXrBKd7YaQUAAwY9bC8e5YrfwEWK5hy5U74al7NNIQDCZCvK64SyzvdWDtZBOwB3s9LUwtQMcfWq8DcNRiLYZCy7DxFE7QuJxF6yR4av8pHHKnZCsiADD5PnS8JUPC5xQQHaXTyspUiZAZC', NULL, NULL, 'Facebook', '1460833691344795'),
('G-108321858974021678564', 'ya29.a0AfB_byAbMgD7YK4bjTgmsHT_m3vx5k8YdoK7y4Q3MROBIweBNIufYQ_2-4mHjZ8dNsbirN7R6v8l9kvtBsauF6-IiLsBLadvaO71a7pY1PlfwUZAHRHayxfUZyZhdy3ETWJVI2CxDuFLnAvmHfXFtdTFcTveaCgYKAYESARASFQHsvYls8Q8I2HnK6_OsYYyZnxeQmg0163', '1//0gJfqobqc9WL5CgYIARAAGBASNwF-L9IrBV7ivp9COm_puY1kbsowgTo-TWWZoJC_Nd_6JOLCEm-ticO-JHr8a-zMZqClumGfjbI', '3599', 'Google', '108321858974021678564');

-- --------------------------------------------------------

--
-- Table structure for table `uploader`
--

CREATE TABLE `uploader` (
  `KODE_UPLOADER` varchar(50) NOT NULL,
  `USER_ID` varchar(50) DEFAULT NULL,
  `ID` varchar(25) NOT NULL,
  `WISATA` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `ID_USER` varchar(50) NOT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `GAMBAR_PROFIL` longtext DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `STATUS` enum('aktif','nonaktif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`ID_USER`, `USERNAME`, `GAMBAR_PROFIL`, `EMAIL`, `STATUS`) VALUES
('108321858974021678564', 'Amar Ma\'ruf', 'https://lh3.googleusercontent.com/a/AAcHTtd88YwryQXff1FdxrxJZ1nyZyFVDsV6veUd1hQS65dKaOo=s96-c', 'amarmaruf2403@gmail.com', 'aktif'),
('1460833691344795', 'Hubby', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=1460833691344795&height=200&width=200&ext=1693546553&hash=AeRIMGVnnStZWe5GGr0', NULL, 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`ID_AKUN`),
  ADD KEY `USERNAME` (`USERNAME`),
  ADD KEY `ID_TOKEN` (`ID_TOKEN`);

--
-- Indexes for table `buka_tutup_wisata`
--
ALTER TABLE `buka_tutup_wisata`
  ADD PRIMARY KEY (`KODE_JAM_OPERASI`);

--
-- Indexes for table `desa`
--
ALTER TABLE `desa`
  ADD PRIMARY KEY (`ID_DESA`),
  ADD KEY `FK_MEMPUNYAI` (`KODE_POS`),
  ADD KEY `NAMA_DESA` (`NAMA_DESA`);

--
-- Indexes for table `gps`
--
ALTER TABLE `gps`
  ADD PRIMARY KEY (`KODE`),
  ADD KEY `FK_ALAMAT` (`KODE_POS`),
  ADD KEY `FK_TIAP` (`ID`);

--
-- Indexes for table `hari_operasional_wisata`
--
ALTER TABLE `hari_operasional_wisata`
  ADD PRIMARY KEY (`ID_OPERASIONAL`),
  ADD KEY `FK_BEBERAPA` (`KODE_UPLOADER`),
  ADD KEY `FK_BEBERAPA_MEMILIKI_YANG_SAMA` (`KODE_JAM_OPERASI`),
  ADD KEY `FK_BEBERAPA_SAMA` (`ID`),
  ADD KEY `FK_MEMILIKI_OBJ_WSTA` (`KODE_POS`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`KODE_POS`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil_wisata`
--
ALTER TABLE `profil_wisata`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`ID_TOKEN`),
  ADD KEY `ID_AKUN` (`ID_AKUN`);

--
-- Indexes for table `uploader`
--
ALTER TABLE `uploader`
  ADD PRIMARY KEY (`KODE_UPLOADER`),
  ADD KEY `FK_JUGA_BEBERAPA` (`ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`ID_USER`),
  ADD KEY `STATUS` (`STATUS`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `FK_ID_TOKEN` FOREIGN KEY (`ID_TOKEN`) REFERENCES `token` (`ID_TOKEN`);

--
-- Constraints for table `desa`
--
ALTER TABLE `desa`
  ADD CONSTRAINT `FK_MEMPUNYAI` FOREIGN KEY (`KODE_POS`) REFERENCES `kecamatan` (`KODE_POS`);

--
-- Constraints for table `gps`
--
ALTER TABLE `gps`
  ADD CONSTRAINT `FK_ALAMAT` FOREIGN KEY (`KODE_POS`) REFERENCES `kecamatan` (`KODE_POS`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `gps_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `profil_wisata` (`ID`);

--
-- Constraints for table `hari_operasional_wisata`
--
ALTER TABLE `hari_operasional_wisata`
  ADD CONSTRAINT `FK_MEMILIKI_OBJ_WSTA` FOREIGN KEY (`KODE_POS`) REFERENCES `kecamatan` (`KODE_POS`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `hari_operasional_wisata_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `profil_wisata` (`ID`),
  ADD CONSTRAINT `hari_operasional_wisata_ibfk_2` FOREIGN KEY (`KODE_UPLOADER`) REFERENCES `uploader` (`KODE_UPLOADER`),
  ADD CONSTRAINT `hari_operasional_wisata_ibfk_3` FOREIGN KEY (`KODE_JAM_OPERASI`) REFERENCES `buka_tutup_wisata` (`KODE_JAM_OPERASI`);

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `token_ibfk_1` FOREIGN KEY (`ID_AKUN`) REFERENCES `userlogin` (`ID_USER`);

--
-- Constraints for table `uploader`
--
ALTER TABLE `uploader`
  ADD CONSTRAINT `FK_USER_ID` FOREIGN KEY (`USER_ID`) REFERENCES `userlogin` (`ID_USER`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `uploader_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `profil_wisata` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;