DROP TABLE IF EXISTS gallery_image;
CREATE TABLE gallery_image(
  id BIGSERIAL,
  type TEXT,
  ownerId TEXT,
  rank INTEGER,
  name TEXT,
  description TEXT,
  CONSTRAINT pk_gallery_image_id PRIMARY KEY (id)
)
