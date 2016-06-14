-- 初始化用户角色表
insert into role(id,roleName) values(0,'普通用户');
insert into role(id,roleName) values(1,'送水工人');
insert into role(id,roleName) values(2,'水店店长');
insert into role(id,roleName) values(3,'管理员');

-- 初始化系统管理员
insert into user(userName,passWord,nickName,sex,realName,phoneNumber,email,role,province,city,country,detailAddress) values('adminrunda','f27de3302890370a6fd35d1cfd3e51b2','admin','男','管理员','runda','admin@runda.com',3,'贵州','贵阳','花溪','贵州大学北校区');

-- 初始化水站状态
insert into waterStoreStatue(id,waterStoreStat) values(0,'正常营业');
insert into waterStoreStatue(id,waterStoreStat) values(1,'忙碌中');
insert into waterStoreStatue(id,waterStoreStat) values(2,'休息中');

-- 初始化水站审核状态
insert into waterStoreAuditStatus(id,auditStat) values(0,'待审核');
insert into waterStoreAuditStatus(id,auditStat) values(1,'审核通过');
insert into waterStoreAuditStatus(id,auditStat) values(2,'审核失败');

-- 初始化送水工状态
insert into waterBearerStatue(id,waterBearerStat) values(0,'正常工作');
insert into waterBearerStatue(id,waterBearerStat) values(1,'忙碌中');
insert into waterBearerStatue(id,waterBearerStat) values(2,'休息中');


-- 初始化桶装水品牌
insert into barrelWaterBrand(id,barrelWaterBrandName) values(0,'农夫山泉');
insert into barrelWaterBrand(id,barrelWaterBrandName) values(1,'怡宝');
insert into barrelWaterBrand(id,barrelWaterBrandName) values(2,'乐百氏');
insert into barrelWaterBrand(id,barrelWaterBrandName) values(3,'景田');
insert into barrelWaterBrand(id,barrelWaterBrandName) values(4,'娃哈哈');
insert into barrelWaterBrand(id,barrelWaterBrandName) values(5,'雀巢');
insert into barrelWaterBrand(id,barrelWaterBrandName) values(6,'屈臣氏');
insert into barrelWaterBrand(id,barrelWaterBrandName) values(7,'哇哈哈');
insert into barrelWaterBrand(id,barrelWaterBrandName) values(8,'其他');
-- 初始化桶装水类别
insert into barrelWaterCategory(id,barrelWaterCateName) values(0,'纯净水');
insert into barrelWaterCategory(id,barrelWaterCateName) values(1,'矿泉水');
insert into barrelWaterCategory(id,barrelWaterCateName) values(2,'蒸馏水');
insert into barrelWaterCategory(id,barrelWaterCateName) values(3,'山泉水');
insert into barrelWaterCategory(id,barrelWaterCateName) values(4,'其他');


-- 初始化订单状态
insert into orderStatue(id,orderStatueName) values(0,'订单已提交未付款');
insert into orderStatue(id,orderStatueName) values(1,'订单已付款待分配送水工');
insert into orderStatue(id,orderStatueName) values(2,'订单已取消');
insert into orderStatue(id,orderStatueName) values(3,'订单已分配送水工');
insert into orderStatue(id,orderStatueName) values(4,'订单配送中');
insert into orderStatue(id,orderStatueName) values(5,'订单配送失败');
insert into orderStatue(id,orderStatueName) values(6,'订单配送成功');
insert into orderStatue(id,orderStatueName) values(7,'确认收货');
insert into orderStatue(id,orderStatueName) values(8,'订单完成');

-- 初始化订单类别
insert into orderCategory(id,orderCategoryName) values(0,'已提交');
insert into orderCategory(id,orderCategoryName) values(1,'已取消');
insert into orderCategory(id,orderCategoryName) values(2,'已失败');
insert into orderCategory(id,orderCategoryName) values(3,'已完成');