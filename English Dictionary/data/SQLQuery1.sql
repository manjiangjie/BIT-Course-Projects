create database Assignment3

create table user_table
(
name char(20) primary key,
u_password varchar(20)
)

create table words
(
id int primary key identity,
word char(20),
part_of_speech char(10) null,
meaning char(20),
example char(100) null
)

create table word_book
(
name char(20) foreign key references user_table(name) on delete cascade on update cascade,
word char(20),
part_of_speech char(10) null,
meaning char(20),
example char(100) null
)

create table quotes
(
id int primary key identity,
sentence char(200),
meaning char(200)
)

create table study_plan
(
name char(20) foreign key references user_table(name) on delete cascade on update cascade,
num int,
study_date date
)

create table about
(
author char(20),
copyright char(200),
contact char(200)
)

insert into user_table(name,u_password)
select 'admin','123456' union all
select 'manjiangjie','thisistheuser' union all
select 'test','itsfortest' union all
select 'guest','iamaguest' union all
select 'others','000000'

insert into words(word,part_of_speech,meaning)
select 'abatement','n.','减少，减轻' union all
select 'abbreviate','v.','缩短' union all
select 'aberrant','a.','越轨的；异常的' union all
select 'abet','v.','教唆；鼓励' union all
select 'abeyance','n.','中止，搁置' union all
select 'abhor','v.','憎恨' union all
select 'ablaze','a.','燃烧的；闪耀的' union all
select 'abolition','n.','废除' union all
select 'abrasive','a.','研磨的' union all
select 'abreast','a.','并排的' union all
select 'abridge','v.','删减' union all
select 'abstain','v.','禁绝，放弃' union all
select 'abstruse','a.','难懂的，深奥的' union all
select 'abut','v.','邻接' union all
select 'abysmal','a.','极深的；糟透的'

insert into quotes(sentence,meaning)
select 'Living without an aim is like sailing without a compass. -- John Ruskin','生活没有目标，犹如航海没有罗盘。-- 罗斯金' union all
select 'There is no such thing as a great talent without great will - power. -- Balzac','没有伟大的意志力，便没有雄才大略。 -- 巴尔扎克' union all
select 'Our destiny offers not the cup of despair, but the chalice of opportunity. So let us seize it, not in fear, but in gladness. -- R.M. Nixon','命运给予我们的不是失望之酒，而是机会之杯。因此，梦颐呛廖薹惧，满心愉悦地把握命？- 尼克松' union all
select 'The unexamined life is not worth living. -- Socrates','混混噩噩的生活不值得过。 -- 苏格拉底' union all
select 'What makes life dreary is the want of motive. -- George Eliot','没有了目的，生活便郁闷无光。 -- 乔治 埃略特' union all
select 'You cannot improve your past, but you can improve your future. Once time is wasted, life is wasted.','你不能改变你的过去，但你可以让你的未来变得更美好。一旦时间浪费了，生命就浪费了。' union all
select 'Happiness is a way station between too much and too little.','幸福是太多和太少之间的一站。' union all
select 'Whatever happens, happens for a reason.','任何事情的发生都有原因的。' union all
select 'Every noble work is at first impossible.','每一个伟大的工程最初看起来都是不可能做到的！' union all
select 'Never underestimate your power to change yourself!','永远不要低估你改变自我的能力！'

insert into about(author,copyright,contact)
select 'manjiangjie','Copyright 2014 English Learning App. All rights reserved','Contact me: manjiangjie@gmail.com'