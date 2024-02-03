-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 24-02-03 17:48
-- 서버 버전: 10.3.8-MariaDB
-- PHP 버전: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `bk`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `books`
--

CREATE TABLE `books` (
  `book_ix` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(200) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `publication_date` date NOT NULL,
  `isbn` varchar(20) NOT NULL COMMENT '국제 표준 도서 번호',
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL COMMENT '정가',
  `rental_price` decimal(10,0) NOT NULL COMMENT '대여비용',
  `point` decimal(10,0) NOT NULL,
  `stock_quantity` int(11) NOT NULL COMMENT '재고수량'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `books`
--

INSERT INTO `books` (`book_ix`, `title`, `author`, `genre`, `publication_date`, `isbn`, `description`, `image_path`, `price`, `rental_price`, `point`, `stock_quantity`) VALUES
(1, '총균쇠', '제래드 다이아몬드', '역사', '2023-05-11', '123132132132', '문명의 생성과 번영의 수수께끼를 밝힌 세계적 명저\r\n마침내 만나는 출간 25년 기념 뉴에디션!\r\n학문의 경계를 넘나드는 세계적 석학 재레드 다이아몬드. 인류 문명에 대한 예리한 통찰을 전해온 그의 대표작이자 1998년 퓰리처상 수상작 《총, 균, 쇠》를 새 번역, 새 편집으로 만난다. 왜 어떤 국가는 부유하고 어떤 국가는 가난한가? 왜 어떤 민족은 다른 민족의 정복과 지배의 대상이 되었는가? 생물학, 지리학, 인류학, 역사학 등 다양한 학문의 융합을 통해 장대한 인류사를 풀어내며 오늘날 현대 세계가 불평등한 원인을 종합 규명한 혁신적 저작. 출간 25년 기념 뉴에디션에는 2023년 저자 특별서문과 서울대 인류학과 박한선 교수의 해제, 새 서문과 후기를 수록해 풍성한 읽을거리를 더했다.', './STATIC/img/book/9788934942467.jpg', '29800', '3000', '55', 1),
(2, '타인을 읽는 말', '로런스 앨리슨, 에밀리 앨리슨', '심리학', '2021-01-15', '123124444', '테러리스트, 직장 상사, 말 안 듣는 아이까지 누구에게 어디서도 통하는 심리학자의 대화법\r\n“저자들은 나의 학문적 영웅이다.” - 말콤 글래드웰\r\n“어느 고위 장교는 이렇게 말했다. 저자들에게 대테러 심리 전략을 배우다가 좋은 아버지가 되는 법까지 알게 됐다고.” -〈가디언〉\r\n\r\n2004년 미군이 이라크 전쟁포로를 학대하는 영상이 대중에게 공개되며 큰 파장이 일어났다. 미국 정보기관은 영국 최고의 범죄심리학자이자 20여 년 동안 가족, 청소년 심리 치료를 해온 앨리슨 부부에게 기존 대테러 심문 전략의 평가와 새로운 접근법을 만들 것을 의뢰한다. 앨리슨 부부는 세계 곳곳의 정보요원, 검찰, 경찰, 테러용의자 및 범죄 용의자와 2,000시간 이상 인터뷰를 진행했다. 연구 결과, 알려진 상식과 달리 압박과 회유 그리고 고문 등은 상대를 설득하거나 정보를 얻는 데 거의 효과가 없다는 것이 밝혀졌다.\r\n\r\n반면 상대의 말에 공감하고, 자율권을 보장하고, 내가 원하는 바를 직설적으로 말할수록 상대 또한 마음의 문을 열었다. 또한 테러리스트, 직장 상사, 10대 청소년까지 인간이라면 누구나 대립, 추종, 통제, 협력이라는 네 가지 소통 방식으로 대화한다는 사실을 알아냈다. 저자들은 이런 연구 결과를 바탕으로 HEAR(Honesty, Empathy, Autonomy, Reflection) 대화 원칙과 네 가지 동물 상징으로 소통 유형을 정리한 애니멀 서클을 완성했다.\r\n\r\n저자들이 개발한 심리 대화법은 현재 미국, 영국 정보기관과 경찰, 검찰에서 신문 전략으로 쓰이고 있으며 부모와 청소년의 심리 상담 및 치료에도 중요한 방법론으로 사용되고 있다. 《타인을 읽는 말》은 저자들의 대화법을 일상에서 누구나 손쉽게 적용할 수 있도록 정리한 대중 심리서이다.', './STATIC/img/book/9788965964223.jpg', '18000', '2000', '30', 2),
(3, '이어령의 마지막 수업', '김지수', '인문', '2021-10-28', '4455555566', '시대의 지성 이어령과 ‘인터스텔라’ 김지수의 ‘라스트 인터뷰’\r\n삶과 죽음에 대한 마지막 인생 수업\r\n이 시대의 대표지성 이어령이 마지막으로 들려주는 삶과 죽음에 대한 가장 지혜로운 이야기가 담긴 책이다. 오랜 암 투병으로 죽음을 옆에 둔 스승은 사랑, 용서, 종교, 과학 등 다양한 주제를 넘나들며, 우리에게 “죽음이 생의 한가운데 있다는 것”을 낮고 울림 있는 목소리로 전달한다.\r\n\r\n지난 2019년 가을, 「김지수의 인터스텔라」 ‘이어령 마지막 인터뷰’ 기사가 나가고, 사람들은 “마이 라이프는 기프트였다”라고 밝힌 이어령 선생님의 메시지에 환호했다. 7천여 개 이상의 댓글이 달리는 등 큰 화제를 모은 이 인터뷰는 그의 더 깊은 마지막 이야기를 담기 위한 인터뷰로 이어지며 이 책을 탄생시켰다. 1년에 걸쳐 진행된 열여섯 번의 인터뷰에서 스승은 독자들에게 자신이 새로 사귄 ‘죽음’이란 벗을 소개하며, ‘삶 속의 죽음’ 혹은 ‘죽음 곁의 삶’에 관해 이야기한다.\r\n\r\n스승 이어령은 삶과 죽음에 대해 묻는 제자에게 은유와 비유로 가득한 답을 내놓으며, 인생 스승으로서 세상에 남을 제자들을 위해 자신이 가진 모든 것을 쏟아낸다. “유언의 레토릭”으로 가득 담긴 이 책은 죽음을 마주하며 살아가는 스승이 전하는 마지막 이야기이며, 남아 있는 세대에게 전하는 삶에 대한 가장 지혜로운 답이 될 것이다.', './STATIC/img/book/9791170400523.jpg', '16500', '1800', '30', 0),
(4, '검은꽃', '김영하', '한국소설', '2020-07-20', '74894949494', '김영하의 『검은 꽃』,\r\n숨이 멎을 듯한 대서사시의 결정판을 만나다!\r\n복복서가에서는 2020년 김영하 등단 25주년을 맞아, \'복복서가x김영하_소설\'이라는 이름으로 장편소설과 소설집을 새로이 출간한다. 『검은 꽃』, 『엘리베이터에 낀 그 남자는 어떻게 되었나』, 『아랑은 왜』 세 권을 먼저 선보인 후, 2022년까지 총 열두 권을 낼 계획이다. 『검은 꽃』은 작가 김영하의 세번째 장편소설로 2003년 문학동네에서 초판이 출간되었다.\r\n\r\n작가 스스로 ‘만약 내 소설 중 단 한 권만 읽어야 한다면 바로 『검은 꽃』’이라고 밝힌 바 있는 명실상부한 대표작 『검은 꽃』이 개정판으로 새롭게 출간되었다. 첫 출간 당시부터 ‘역사소설이라는 맥이 풀려버린 장르를 미학적 가능성의 새로운 영역으로 등재해놓았다(서영채)’는 평가가 보여주듯 문학계 내외에 신선한 충격을 안겼던 이 소설은 지금까지 50쇄 넘게 중쇄를 거듭할 만큼 독자들의 꾸준한 지지와 사랑도 받아왔다. 동인문학상 수상 당시 “가장 약한 나라의 가장 힘없는 사람들의 인생경영을 강렬하게 그린 작품”이며, “올해의 한국문학이 배출한 최고의 수작”이라는 찬사를 받았고 여러 매체에서 ‘올해의 책’으로 선정되었다. 복복서가판에서는 문장을 면밀히 다듬고 몇몇 주요 장면을 수정해 “이전 판과 꽤 다른 결의 소설로 변모”(‘개정판을 내며’ 중에서)했다. 또한, 책 말미에 남진우와 서영채의 해설과 작품론을 실어 『검은 꽃』을 더욱 풍부하고 깊이 있게 이해할 수 있도록 하였다.', './STATIC/img/book/9791197021633.jpg', '11000', '1500', '25', 1),
(5, '프리즘', '손원평', '장편소설', '2020-09-15', '9791191071030', '하나하나 다른 마음과 생각으로 살아가고 있는 사람들……\r\n나는 누구와 연결되어 있을까\r\n\r\n아름답고 날카롭게 산란하는 사랑의 빛깔들『프리즘』. 타인에 대한 몰이해와 공감하지 못하는 현실을 감각적인 문체로 그려내는 작가 손원평의 작품이다. 이 소설은 네 남녀의 사랑에 대해, 만남과 이별의 과정에서 여러 갈래로 흩어지는 ‘마음’을 다양한 빛깔로 비추어가는 이야기이다. 타인과의 관계맺음이 불러오는 다양한 성장통에 천착했던 작가는 《프리즘》을 통해 사랑과 연애라는 어른들의 관계를 통해 스스로 얼마나 반추할 수 있는지, 더불어 얼마나 자기 자신을 좋아할 수 있는지를 말하고 있다. 사랑이 퇴색되어버린 남자 도원, 상처와 후회를 억지로 견뎌내는 재인, 아프고 후회해도 사랑을 멈출 수 없는 예진, 단 한 사람도 마음 안으로 들이지 못하는 호계. 이 네 주인공의 사랑에 대해, 사랑으로 움직여지는 그 마음의 각각의 지점들에 대한 이야기가 작가 손원평의 잔잔한 톤과 함께 밀도 높은 문장으로 그려진다.\r\n\r\n소설은 같은 건물에서 일하는 두 사람 예진과 도원의 만남에서 시작한다. 둘은 점심시간이 되면 일터를 벗어나 누군가와 마주칠 염려 없는, 걸터앉기 좋은 자리가 있는 빈 건물 1층에서 나란히 커피를 마신다. 누군가를 좋아하지 않기로 결심한 지 얼마 되지 않은 ‘예진’. 영화 후시녹음 업체에서 일하는 ‘도원’. 두 사람은 딱 적당한 거리만큼의 간격으로 나란히 앉아 싱거운 대화를 나누며 거리의 소음과 따사로운 햇살을 맞는다. 짤막한 대화가 전부지만 두어 번은 거리를 같이 산책한 적도 있다. 어느 순간 두 사람 중 누군가 한 발짝 다가오면 연인이 될 수 있을지도 모른다. 하지만 도원은 지금의 이 간격이 좋다. 지금만큼의 거리를 유지하는 평행선. 그게 도원이 생각하는 예진과의 마음의 거리다.', './STATIC/img/book/9791191071030.jpg', '12150', '1300', '30', 1),
(6, '나는 나를 파괴할 권리가 있다', '김영하', '장편소설', '2022-05-23', '9791191114072', '충격적 신예의 탄생, 가장 강렬한 자기 출현의 예고!\r\n『나는 나를 파괴할 권리가 있다』 개정판\r\n\r\n김영하 등단 25주년을 맞이해 시작된 ‘복복서가×김영하 소설’ 시리즈 2차분 3종이 출간되었다. 김영하라는 이름을 문단과 대중에 뚜렷이 각인시킨 첫 장편소설 『나는 나를 파괴할 권리가 있다』, 분단 이후 한국 문학사에 새로운 이정표를 세운 『빛의 제국』, 그리고 비교적 최근작인 소설집 『오직 두 사람』이다.\r\n‘자살안내인’이라는 기괴한 직업을 가진 화자를 등장시켜 그가 만난 ‘고객’들의 일탈적 삶과 죽음을 이야기하는 『나는 나를 파괴할 권리가 있다』는 한국문학의 감수성을 김영하 출현 이전과 이후로 갈라놓은 문제작이다. 복복서가판은1996년 초판의 모습을 보존한다는 취지에 충실했던 지난 개정판들과 달리, 원숙기에 접어든 작가가 세밀하게 다듬은 마지막 결정판이 될 것으로 보인다.', './STATIC/img/book/9791191114072.jpg', '10350', '1100', '20', 1),
(7, '작별인사', '김영하', '장편소설', '2022-05-02', '9791191114225', '누구도 도와줄 수 없는 상황, 혼자 헤쳐나가야 한다\r\n지켜야 할 약속, 붙잡고 싶은 온기\r\n\r\n김영하가 『살인자의 기억법』 이후 9 년 만에 내놓는 장편소설 『작별인사』는 그리 멀지 않은 미래를 배경으로, 별안간 삶이 송두리째 뒤흔들린 한 소년의 여정을 좇는다. 유명한 IT 기업의 연구원인 아버지와 쾌적하고 평화롭게 살아가던 철이는 어느날 갑자기 수용소로 끌려가 난생처음 날것의 감정으로 가득한 혼돈의 세계에 맞닥뜨리게 되면서 정신적, 신체적 위기에 직면한다. 동시에 자신처럼 사회에서 배제된 자들을 만나 처음으로 생생한 소속감을 느끼고 따뜻한 우정도 싹틔운다. 철이는 그들과 함께 수용소를 탈출하여 집으로 돌아가기 위해 길을 떠나지만 그 여정에는 피할 수 없는 질문이 기다리고 있다.\r\n\r\n『작별인사』의 탄생과 변신, 그리고 기원\r\n\r\n『작별인사』는 김영하가 2019년 한 신생 구독형 전자책 서비스 플랫폼으로부터 회원들에게 제공할 짧은 장편소설을 써달라는 청탁을 받고 집필한 소설이다. 회원들에게만 제공하는 소설이라는 점은 『살인자의 기억법』 발표 이후 6년이나 장편을 발표하지 못했던 작가의 무거운 어깨를 가볍게 해주었다. 작업은 속도감 있게 진행되어 2020년 2월, 『작별인사』가 해당 서비스의 구독 회원들에게 배송되었다. 분량은 200자 원고지 420매 가량이었다.\r\n원래 작가는 『작별인사』를 조금 고친 다음, 바로 일반 독자들이 접할 수 있도록 정식 출간할 생각이었다. 그러나 2020년 3월이 되자 코로나19 바이러스 팬데믹이 시작되었다. 뉴욕의 텅 빈 거리에는 시체를 실은 냉동트럭들만 음산한 기운을 풍기며 서 있었고, 파리, 런던, 밀라노의 거리에선 인적이 끊겼다. 작가들이 오랫동안 경고하던 디스토피아적 미래가 갑자기 도래한 것 같았다. 책상 앞에서 가벼운 마음으로 썼던 경장편 원고를 고쳐나가던 작가에게 몇 달 전에 쓴 원고가 문득 낯설게 느껴진 순간이 왔다. 작가는 고쳐쓰기를 반복했고, 원고는 점점 2월에 발표된 것과는 다른 곳으로 향하고 있었다. 여름이면 끝날 줄 알았던 팬데믹은 겨울이 되면서 더욱 기승을 부렸고, 백신이 나와도 기세가 꺾이지 않았다. 세계보건기구 WHO가 팬데믹을 선언한 지 2년이 지나서야 작가는 『작별인사』의 개작을 마쳤다. 420매 분량이던 원고는 약 800매로 늘었고, 주제도 완전히 달라졌다. ‘인간을 인간으로 만드는 것은 무엇인가?’, ‘인간과 인간이 아닌 존재들을 가르는 경계는 어디인가’를 묻던 소설은 ‘삶이란 과연 계속될 가치가 있는 것인가?’, ‘세상에 만연한 고통을 어떻게 하면 줄일 수 있을 것인가’, ‘어쩔 수 없이 태어났다면 어떻게 살고 어떻게 죽어야 할 것인가’와 같은 질문을 던지는 이야기로 바뀌었다. 팬데믹이 개작에 영향을 주었을 수도 있고, 원래 『작별인사』의 구상에 담긴 어떤 맹아가 오랜 개작을 거치며 발아했는지도 모른다. 그것에 대해 작가는 이렇게 말하고 있다.\r\n\r\n마치 제목이 어떤 마력이 있어서 나로 하여금 자기에게 어울리는 이야기로 다시 쓰도록 한 것 같은 느낌이다. 탈고를 하고 얼마 지나지 않아 원고를 다시 읽어보았다. 이제야 비로소 애초에 내가 쓰려고 했던 어떤 것이 제대로, 남김 없이 다 흘러나왔다는 생각이 들었다. _’작가의 말’에서\r\n전면적인 수정을 통해 2022년의 『작별인사』는 2020년의 『작별인사』를 마치 시놉시스나 초고처럼 보이게 할 정도로 확연하게 달라졌다. 그리고 김영하의 이전 문학 세계와의 연결점들이 분명해졌다.\r\n\r\n제목을 『작별인사』라고 정한 것은 거의 마지막 순간에서였다. 정하고 보니 그동안 붙여두었던 가제들보다 훨씬 잘 맞는 것 같았다. 재미있는 것은 ‘작별인사’라는 제목을 내가 지금까지 발표한 다른 소설에 붙여 보아도 다 어울린다는 것이다. 『나는 나를 파괴할 권리가 있다』, 『검은 꽃』, 『빛의 제국』, 심지어 『살인자의 기억법』이어도 다 그럴 듯 했을 것이다. _’작가의 말’에서', './STATIC/img/book/9791191114225.jpg', '12600', '1200', '30', 1),
(8, '성격의 탄생', '대니얼 네틀', '교양심리', '2019-11-10', '9791186993095', '내 성격은 어떻게 만들어진 걸까?\r\n왜 사람마다 성격이 다를까?\r\n성격을 바꿀 수 있을까?\r\n성격의 근원을 규명하는 가장 지적인 성격 탐구서!\r\n\r\n대인갈등, 콤플렉스, 불안의 근원 - 성격\r\n\r\n대인갈등, 콤플렉스, 근심, 불안. 그 근원에는 ‘성격’이 도사리고 있다. 나의 가치관, 직업, 사랑, 인간관계 모두 성격이 만들어낸 결과다. 성격이 중요한 이유는 무엇일까? 행동과학자이자 심리학자인 저자는 성격이 우리 삶을 결정하기 때문에 중요한 문제라고 말한다. 성격이 좋아서 사랑받고, 성격이 나빠서 따돌림 당하며, 성격 차이로 이별한다. 성격으로 그 사람의 행불행을 예측할 수도 있다.\r\n‘성격’을 규명하기 위해 저자는 “내 성격은 이렇다”고 단정할 만한 과학적 기준이 있는지, 성격의 개인차는 왜, 어떻게 존재하는지 등 의문을 풀어나간다. 수백 명에 대한 성격 조사와 전 세계 사람들의 라이프스토리, 진화심리학과 유전학, 뇌과학 연구가 그 기초가 되었다.\r\n우선, 저자는 독자 스스로 자신의 성격을 진단할 수 있도록 앞부분에 ‘성격진단표’를 첨부하고, 곧이어 ‘외향성’ ‘신경성’ 성실성’ ‘친화성’ ‘개방성’ 등 ‘5대 성격특성’을 소개하면서 사람들의 성격을 유형화한다. 이를 통해 성격의 특징과 장단점을 종합적으로 평가하고 인간 성격에 내재된 흥미로운 이야기를 풀어낸다. 유전학과 뇌과학 분야의 최신 연구결과들을 바탕으로 성격이 서로 다른 진화론적 이유가 명쾌하게 제시된다.\r\n', './STATIC/img/book/9791186993095.jpg', '15750', '1500', '35', 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `cart`
--

CREATE TABLE `cart` (
  `cart_ix` int(11) NOT NULL,
  `user_ix` int(11) NOT NULL,
  `book_ix` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `rental_price` decimal(10,0) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `cart`
--

INSERT INTO `cart` (`cart_ix`, `user_ix`, `book_ix`, `quantity`, `rental_price`, `create_time`) VALUES
(8, 1, 3, 1, '1800', '2024-01-26 15:54:45'),
(9, 1, 4, 1, '1500', '2024-01-26 15:55:22');

-- --------------------------------------------------------

--
-- 테이블 구조 `delivery`
--

CREATE TABLE `delivery` (
  `delivery_ix` int(11) NOT NULL,
  `user_ix` int(11) NOT NULL,
  `delivery_name` varchar(200) NOT NULL COMMENT '배송지명',
  `receiver_name` varchar(200) NOT NULL COMMENT '수령인',
  `receiver_contact` varchar(200) NOT NULL COMMENT '수령인 연락처',
  `receiver_address` tinytext NOT NULL COMMENT '주소',
  `receiver_address2` varchar(200) NOT NULL,
  `is_basic` tinyint(4) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `delivery`
--

INSERT INTO `delivery` (`delivery_ix`, `user_ix`, `delivery_name`, `receiver_name`, `receiver_contact`, `receiver_address`, `receiver_address2`, `is_basic`, `create_time`, `update_time`) VALUES
(4, 0, '다시집', '한장호', '010-5613-5430', '[57997] 전남 순천시 우석로 56', '낚시타운', 0, '2024-01-09 11:53:04', '0000-00-00 00:00:00'),
(7, 0, '집', '장하령1', '010-2982-0041', '[57997] 전남 순천시 우석로 56', '낚시타운', 0, '2024-01-11 10:43:25', '0000-00-00 00:00:00'),
(8, 0, '인천집', '한장호', '010-5613-5430', '[21558] 인천 남동구 예술로192번길 35', '룩소르6차 503호', 1, '2024-01-12 10:06:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 테이블 구조 `orders`
--

CREATE TABLE `orders` (
  `order_ix` int(11) NOT NULL,
  `order_num` varchar(200) NOT NULL DEFAULT '',
  `user_ix` int(11) DEFAULT NULL,
  `delivery_ix` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,0) DEFAULT NULL,
  `discount_amount` decimal(10,0) NOT NULL,
  `points_used` int(11) NOT NULL DEFAULT 0,
  `status` enum('pending','processing','completed','cancelled') DEFAULT 'pending',
  `memo` tinytext NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `orders`
--

INSERT INTO `orders` (`order_ix`, `order_num`, `user_ix`, `delivery_ix`, `order_date`, `total_amount`, `discount_amount`, `points_used`, `status`, `memo`) VALUES
(24, '1643706618', 1, 8, '2024-01-26 10:49:55', '10300', '10297', 3, 'pending', ''),
(26, '1706925435', 1, 8, '2024-02-03 01:57:15', '6800', '6800', 0, 'processing', ''),
(27, '1706925506', 1, 8, '2024-02-03 01:58:26', '6200', '6200', 0, 'completed', ''),
(28, '1706925526', 1, 8, '2024-02-03 01:58:46', '6100', '6100', 0, 'cancelled', ''),
(29, '1706925676', 1, 8, '2024-02-03 02:01:16', '8000', '8000', 0, 'pending', ''),
(30, '1706925731', 1, 8, '2024-02-03 02:02:11', '6300', '6300', 0, 'cancelled', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `order_details`
--

CREATE TABLE `order_details` (
  `order_details_ix` int(11) NOT NULL,
  `order_ix` int(11) NOT NULL,
  `ownership_ix` int(11) NOT NULL COMMENT '소유권 ix',
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unit_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `order_details`
--

INSERT INTO `order_details` (`order_details_ix`, `order_ix`, `ownership_ix`, `quantity`, `unit_price`) VALUES
(98, 24, 4, 1, '1500'),
(99, 24, 3, 1, '1800'),
(100, 26, 11, 1, '1800'),
(101, 27, 7, 1, '1200'),
(102, 28, 14, 1, '1100'),
(103, 29, 1, 1, '3000'),
(104, 30, 13, 1, '1300');

-- --------------------------------------------------------

--
-- 테이블 구조 `ownership`
--

CREATE TABLE `ownership` (
  `ownership_ix` int(11) NOT NULL,
  `user_ix` int(11) DEFAULT NULL COMMENT '책 소유주 IX',
  `book_ix` int(11) DEFAULT NULL,
  `status` enum('available','checked_out') DEFAULT 'available',
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `ownership`
--

INSERT INTO `ownership` (`ownership_ix`, `user_ix`, `book_ix`, `status`, `create_time`) VALUES
(1, 1, 1, 'checked_out', '2024-01-26 17:45:41'),
(2, 1, 2, 'available', '2024-01-26 17:45:41'),
(3, 1, 3, 'checked_out', '2024-01-26 17:45:41'),
(4, 1, 4, 'checked_out', '2024-01-26 17:45:41'),
(5, 1, 5, 'available', '2024-01-26 17:45:41'),
(6, 1, 6, 'available', '2024-01-26 17:45:41'),
(7, 1, 7, 'checked_out', '2024-01-26 17:45:41'),
(8, 1, 8, 'available', '2024-01-26 17:45:41'),
(9, 2, 1, 'available', '2024-01-26 17:45:41'),
(10, 2, 2, 'available', '2024-01-26 17:45:41'),
(11, 2, 3, 'checked_out', '2024-01-26 17:45:41'),
(12, 2, 4, 'available', '2024-01-26 17:45:41'),
(13, 2, 5, 'available', '2024-01-26 17:45:41'),
(14, 2, 6, 'available', '2024-01-26 17:45:41'),
(15, 2, 7, 'available', '2024-01-26 17:45:41'),
(16, 2, 8, 'available', '2024-01-26 17:45:41');

-- --------------------------------------------------------

--
-- 테이블 구조 `points_history`
--

CREATE TABLE `points_history` (
  `point_ix` int(11) NOT NULL,
  `user_ix` int(11) NOT NULL,
  `type` varchar(200) NOT NULL COMMENT '적립,출금',
  `order_num` varchar(200) NOT NULL,
  `val` int(11) NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `points_history`
--

INSERT INTO `points_history` (`point_ix`, `user_ix`, `type`, `order_num`, `val`, `create_date`) VALUES
(1, 1, '적립', '12561616', 55, '2024-02-01'),
(2, 1, '출금', '', 10000, '2024-02-01'),
(3, 1, '적립', '12561616', 55, '2024-02-01'),
(4, 1, '적립', '12561616', 55, '2024-02-01'),
(5, 1, '적립', '12561616', 55, '2024-02-01'),
(6, 1, '적립', '12561616', 55, '2024-02-01'),
(7, 1, '적립', '12561616', 55, '2024-02-01'),
(8, 1, '적립', '12561616', 55, '2024-02-01'),
(9, 1, '적립', '12561616', 55, '2024-02-01'),
(10, 1, '적립', '12561616', 55, '2024-02-01'),
(11, 1, '적립', '12561616', 55, '2024-02-01'),
(12, 1, '적립', '12561616', 55, '2024-02-01'),
(13, 1, '적립', '12561616', 55, '2024-02-01'),
(14, 1, '적립', '12561616', 55, '2024-02-01'),
(15, 1, '적립', '12561616', 55, '2024-02-01'),
(16, 1, '적립', '12561616', 55, '2024-02-01'),
(17, 1, '적립', '12561616', 55, '2024-02-01');

-- --------------------------------------------------------

--
-- 테이블 구조 `rental_history`
--

CREATE TABLE `rental_history` (
  `rental_ix` int(11) NOT NULL,
  `user_ix` int(11) DEFAULT NULL COMMENT '대여한 사용자',
  `ownership_ix` int(11) DEFAULT NULL COMMENT '소유 ix',
  `rental_date` date NOT NULL DEFAULT current_timestamp(),
  `return_date` date NOT NULL DEFAULT '0000-00-00',
  `status` enum('rented','returned') DEFAULT 'rented'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `rental_history`
--

INSERT INTO `rental_history` (`rental_ix`, `user_ix`, `ownership_ix`, `rental_date`, `return_date`, `status`) VALUES
(9, 1, 4, '2024-01-26', '2024-02-13', 'rented'),
(10, 1, 3, '2024-01-26', '2024-02-13', 'rented'),
(11, 1, 11, '2024-02-03', '2024-02-12', 'rented'),
(12, 1, 7, '2024-02-03', '2024-02-12', 'rented'),
(14, 1, 1, '2024-02-03', '2024-02-12', 'rented');

-- --------------------------------------------------------

--
-- 테이블 구조 `tmp_order`
--

CREATE TABLE `tmp_order` (
  `tmp_order_ix` int(11) NOT NULL,
  `user_ix` int(11) NOT NULL,
  `book_ix` int(11) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `rental_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `tmp_order`
--

INSERT INTO `tmp_order` (`tmp_order_ix`, `user_ix`, `book_ix`, `quantity`, `rental_price`) VALUES
(66, 1, 2, 1, '2000');

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `user_ix` int(11) NOT NULL,
  `login_type` varchar(100) NOT NULL DEFAULT 'basic',
  `user_id` varchar(200) NOT NULL,
  `user_pwd` varchar(200) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_contact` varchar(255) NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`user_ix`, `login_type`, `user_id`, `user_pwd`, `user_name`, `user_contact`, `points`, `create_time`) VALUES
(1, 'basic', 'wkdgh5430', '807bbb1fd86a69c2ada06b897ca488f6', '한장호', '010-5613-5430', 290, '2024-01-12 12:14:30');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_ix`);

--
-- 테이블의 인덱스 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_ix`);

--
-- 테이블의 인덱스 `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_ix`);

--
-- 테이블의 인덱스 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ix`);

--
-- 테이블의 인덱스 `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_ix`);

--
-- 테이블의 인덱스 `ownership`
--
ALTER TABLE `ownership`
  ADD PRIMARY KEY (`ownership_ix`);

--
-- 테이블의 인덱스 `points_history`
--
ALTER TABLE `points_history`
  ADD PRIMARY KEY (`point_ix`);

--
-- 테이블의 인덱스 `rental_history`
--
ALTER TABLE `rental_history`
  ADD PRIMARY KEY (`rental_ix`);

--
-- 테이블의 인덱스 `tmp_order`
--
ALTER TABLE `tmp_order`
  ADD PRIMARY KEY (`tmp_order_ix`);

--
-- 테이블의 인덱스 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ix`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `books`
--
ALTER TABLE `books`
  MODIFY `book_ix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_ix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 테이블의 AUTO_INCREMENT `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_ix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `order_ix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- 테이블의 AUTO_INCREMENT `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_ix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- 테이블의 AUTO_INCREMENT `ownership`
--
ALTER TABLE `ownership`
  MODIFY `ownership_ix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- 테이블의 AUTO_INCREMENT `points_history`
--
ALTER TABLE `points_history`
  MODIFY `point_ix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 테이블의 AUTO_INCREMENT `rental_history`
--
ALTER TABLE `rental_history`
  MODIFY `rental_ix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 테이블의 AUTO_INCREMENT `tmp_order`
--
ALTER TABLE `tmp_order`
  MODIFY `tmp_order_ix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- 테이블의 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `user_ix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
