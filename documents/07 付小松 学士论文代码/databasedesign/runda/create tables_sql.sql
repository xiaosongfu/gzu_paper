create database runda;
use runda;
-- 1 角色表
create table role(
id tinyint not null primary key,
roleName varchar(8) not null
);

-- 2 用户表
create table user(
id int not null auto_increment primary key,
userName varchar(40) not null unique,  -- 唯一
password varchar(32) not null,
nickName varchar(40),
sex char(2) not null,
realName varchar(10),
photo varchar(600) default '/Content/image/userphotograph/photo.png',
phoneNumber char(11) not null unique, -- 唯一
email varchar(60), -- 唯一
idCardGraphFront varchar(600),
idCardGraphBack varchar(600),
idCardNumber varchar(18),
isRealNameAuthen tinyint not null default 0,
role tinyint not null default 0,
isLock tinyint not null default 0,-- 这保留，但论文中不用写。
province varchar(10) not null,
city varchar(10) not null,
country varchar(10) not null,
detailAddress varchar(100) not null,
foreign key(role) references role(id) ON DELETE NO ACTION
)auto_increment=10000;

-- 3 用户收货地址表
create table userRecieverAddress(
id int not null auto_increment primary key,
userID int not null,
province varchar(10) not null,
city varchar(10) not null,
country varchar(10) not null,
detailAddress varchar(100) not null,
foreign key(userID) references user(id) ON DELETE CASCADE
);

-- /////////////////////////////////////////////////////
-- 4 水店状态表
create table waterStoreStatue(
id tinyint not null primary key,
waterStoreStat varchar(4) not null
);
-- 5 水店审核状态表
create table waterStoreAuditStatus(
id tinyint not null primary key,
auditStat varchar(4) not null
);
-- 6 水店表
create table waterStore(
id int not null auto_increment primary key,
owner int not null unique,
waterStoreName varchar(100) not null,
waterStoreTellPhone char(11) not null,
waterStoreFixedLinePhone char(12),-- 085185569725
waterStoreEmail varchar(60),
waterStoreImage varchar(600) default '/Content/image/waterstoreimage/photo.png',
isLock tinyint not null default 0,-- 数据库中保留，但论文中不要写。
waterStoreStatus tinyint not null default 0,
auditStatus tinyint not null default 0,
auditDetail varchar(100),
province varchar(10) not null,
city varchar(10) not null,
country varchar(10) not null,
detailAddress varchar(100) not null,
waterStoreLongitude varchar(20),-- 经度
waterStoreLatitude varchar(20), -- 纬度
businessLicense varchar(600) not null,
foreign key(owner) references user(id) ON DELETE CASCADE,
foreign key(waterStoreStatus) references waterStoreStatue(id) ON DELETE NO ACTION,
foreign key(auditStatus) references waterStoreAuditStatus(id) ON DELETE NO ACTION
)auto_increment=10000;

-- ！！！！！！！！！！！！！！！！！！！！！
-- 7 水店评价表  删除： 2016年5月18日11:35:19
-- create table waterStoreComments(
-- id int not null auto_increment primary key,
-- userID int not null,
-- waterStoreID int not null,
-- CommentContent text,
-- reply text,
-- CommentTime int not null,
-- agreeCount int default 0,
-- againstCount int default 0,
-- foreign key(userID) references user(id) ON DELETE CASCADE,
-- foreign key(waterStoreID) references waterStore(id) ON DELETE CASCADE
-- );

-- /////////////////////////////////////////////////////
-- 7 送水工状态表
create table waterBearerStatue(
id tinyint not null primary key,
waterBearerStat varchar(4) not null
);

-- 8 送水工表
create table waterBearer(
id int not null auto_increment primary key,
userId int not null unique,
waterStoreId int not null,
maxLoadCapacity tinyint not null,
statue  tinyint not null default 0,
foreign key(userId) references user(id) ON DELETE CASCADE,
foreign key(waterStoreId) references waterStore(id) ON DELETE CASCADE,
foreign key(statue) references waterBearerStatue(id) ON DELETE CASCADE
)auto_increment=10000;

-- 9 送水工送水路线表
create table  waterBearerDriverRoute(
id int not null auto_increment primary key,
waterBearerId int not null,
waterBearerPositionLongitude varchar(20) not null,-- 经度
waterBearerPositionLatitude varchar(20) not null, -- 纬度
date char(10) not null, -- 2015-04-12
time char(8) not null,-- 16:45:47
remainCapacity tinyint,
foreign key(waterBearerId) references user(id) ON DELETE CASCADE
);

-- ！！！！！！！！！！！！！！！
-- 10 送水工评价表 删除：2016年5月18日13:17:35
-- create table waterBearerComments(
-- id int not null auto_increment primary key,
-- userID int not null,
-- waterBearerID int not null,
-- CommentContent text,
-- reply text,
-- CommentTime int not null,
-- agreeCount int default 0,
-- againstCount int default 0,
-- foreign key(userID) references user(id) ON DELETE CASCADE,
-- foreign key(waterBearerID) references user(id) ON DELETE CASCADE
-- );

-- /////////////////////////////////////////////////////
-- 10 商品分类表
create table barrelWaterCategory(
id int not null primary key,
barrelWaterCateName varchar(20)
);
-- 11 商品品牌表
create table barrelWaterBrand(
id int not null primary key,
barrelWaterBrandName varchar(20)
);
-- 12 商品表
create table barrelWaterGoods(
id int not null auto_increment primary key,
waterStoreID int not null,
waterCate int not null, -- 类别
waterBrand int not null, -- 品牌
waterGoodsName varchar(100) not null, -- 桶装水名称
waterGoodsDescript text not null, -- 桶装水描述
waterGoodsPrice decimal(6,2) not null, -- 桶装水价格
waterGoodsDefaultImage varchar(600) default '/Content/image/goodspicture/goods.jpg',
waterGoodsInventory int not null default 0,-- 库存
isGrounding tinyint not null default 0, -- 是否上架
groundingDate int not null,  -- 上架时间
salesVolume int not null default 0, -- 销量
foreign key(waterStoreID) references waterStore(id) ON DELETE CASCADE,
foreign key(waterCate) references barrelWaterCategory(id) ON DELETE CASCADE,
foreign key(waterBrand) references barrelWaterBrand(id) ON DELETE CASCADE
);
-- 13 商品图片表
create table barrelWaterGoodsPhotos(
id int not null auto_increment primary key,
waterGoodsID int not null,
waterGoodsPhotoPath varchar(600),
foreign key(waterGoodsID) references barrelWaterGoods(id) ON DELETE CASCADE
);
-- 14 商品评价表
-- create table barrelWaterGoodsComments(
-- id int not null auto_increment primary key,
-- userID int not null unique,
-- waterGoodsID int not null,
-- CommentContent text,
-- reply text,
-- CommentTime int not null,
-- agreeCount int default 0,
-- againstCount int default 0,
-- foreign key(userID) references user(id) ON DELETE CASCADE,
-- foreign key(waterGoodsID) references barrelWaterGoods(id) ON DELETE CASCADE
-- );

-- /////////////////////////////////////////////////////
-- 14 购物车表
create table shoppingCart(
id int not null auto_increment primary key,
cartOwnerID int not null,  -- 所有者ID
waterGoodsID int not null, -- 该条记录的商品ID 
-- waterGoodsName varchar(140) not null,
-- waterGoodsPrice decimal(6,2) not null,
-- waterGoodsDefaultImage varchar(400),
waterGoodsCount tinyint not null default 1, -- 该条记录的商品的数量
addCartTime int, -- 加入购物车时间
foreign key(cartOwnerID) references user(id) ON DELETE CASCADE,
foreign key(waterGoodsID) references barrelWaterGoods(id) ON DELETE CASCADE
);

-- /////////////////////////////////////////////////////
-- 15 订单状态表
create table orderStatue(
id int not null primary key,
orderStatueName varchar(12)
);
-- 16 订单类别表
create table orderCategory(
id int not null primary key,
orderCategoryName varchar(3)
);
-- 17 订单详细表
create table orderDetail(
id int not null auto_increment primary key, 
orderOwnerID int not null,  -- 所有者ID
waterBearerID int, -- 承接的送水工
waterStoreID int not null,
recieverPersonName varchar(10), -- 收货人姓名
recieverPersonPhone char(11), -- 收货人电话
recieverAddress varchar(100), -- 收货地址
-- recieverTime int, -- 收货时间
recieverTime varchar(30), -- 收货时间，是字符串
remark varchar(100), -- 备注
totalPrice decimal(10,2) not null default 0.00, -- 订单总额
settleMethod varchar(20), -- 结算方式
orderCategory int not null default 0, -- 订单类别
orderStatue int not null default 0, -- 订单状态
logisticeInformation text, -- 物流信息
orderCancelReason varchar(100), -- 订单取消原因
orderFailReason varchar(100), -- 订单失败原因
orderSubmitTime int not null, --  订单提交时间
orderDoneTime int, -- 订单完成时间
foreign key(orderOwnerID) references user(id) ON DELETE CASCADE,
foreign key(waterBearerID) references user(id) ON DELETE CASCADE,
foreign key(waterStoreID) references waterStore(id) ON DELETE CASCADE,
foreign key(orderStatue) references orderStatue(id) ON DELETE CASCADE,
foreign key(orderCategory) references orderCategory(id) ON DELETE CASCADE
);
-- 18 订单所包含的商品表
create table orderContainGoods(
id int not null auto_increment primary key,
orderID int not null, -- 订单ID
waterGoodsID int not null, -- 该条记录的商品ID 
waterGoodsCount tinyint not null default 1, -- 该条记录的商品的数量
waterGoodsPrice decimal(6,2), -- 该条记录的商品单价
foreign key(orderID) references orderDetail(id) ON DELETE CASCADE,
foreign key(waterGoodsID) references barrelWaterGoods(id) ON DELETE CASCADE
);
-- 19 订单评价表
create table orderComments(
id int not null auto_increment primary key,
orderID int not null,
userID int not null,
CommentContent text,
-- reply text,
CommentTime int not null,
-- agreeCount int default 0,
-- againstCount int default 0,
foreign key(orderID) references orderDetail(id) ON DELETE CASCADE,
foreign key(userID) references user(id) ON DELETE CASCADE
);

-- 获取桶装水的评价！！！！！！！！
-- select orderComments.userID,orderComments.CommentContent,orderComments.CommentTime from 
-- orderComments join orderContainGoods on orderComments.orderID=orderContainGoods.orderID
-- where orderContainGoods.waterGoodsID=?


-- ！！！！！！！！！！！！！！！
-- 订单评价图片  删除：2016年5月18日13:18:16
-- create table orderCommentsPhotos(
-- id int not null auto_increment primary key,
-- orderID int not null,
-- photoPath varchar(600),
-- foreign key(orderID) references orderDetail(id) ON DELETE CASCADE
-- );

-- /////////////////////////////////////////////////////
-- 20 轮播图片表
create table imageCarousel(
id int not null auto_increment primary key,
imagePath varchar(600) not null,
imageURL varchar(100),
imageDescript varchar(100),
imageUploadTime int not null,
isShow tinyint not null,
imageWeight tinyint not null
)auto_increment=10000;