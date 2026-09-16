CREATE TABLE posts
(
    id INT AUTO_INCREMENT primary key,
    user_id INT not null,
    title varchar(255) not null ,
    content text not null,
    created_at TIMESTAMP default CURRENT_TIMESTAMP,
    update_at TIMESTAMP default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
    foreign key  (user_id) references  users(id) on delete cascade
)