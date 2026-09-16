CREATE TABLE comments
(
    id INT AUTO_INCREMENT primary key,
    posts_id INT not null,
    user_id INT not null,
    content text not null,
    created_at TIMESTAMP default CURRENT_TIMESTAMP,
    foreign key  (posts_id) references  posts(id) on delete cascade,
    foreign key  (user_id) references  users(id) on delete cascade
)