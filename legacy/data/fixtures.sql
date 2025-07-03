-- Insert users first
INSERT INTO users (email, password, display_name, created_at, enabled) VALUES
('admin@example.com', MD5('test'), 'Admin', '2025-06-28 10:00:00', TRUE),
('sarah.connor@example.com', MD5('test'), 'Sarah Connor', '2025-06-28 11:15:00', TRUE),
('rick.deckard@example.com', MD5('test'), 'Rick Deckard', '2025-06-28 12:30:00', TRUE),
('ellen.ripley@example.com', MD5('test'), 'Ellen Ripley', '2025-06-28 13:45:00', TRUE),
('marty.mcfly@example.com', MD5('test'), 'Marty McFly', '2025-06-28 14:00:00', TRUE),
('john.doe@example.com', MD5('test'), 'John Doe', '2025-06-28 14:15:00', FALSE);

-- Insert categories first
INSERT INTO blog_categories (name, description) VALUES
('Crime Drama', 'Analysis of classic crime and mafia films'),
('Romance', 'Exploring romantic moments in cinema history'),
('Science Fiction', 'Deep dives into sci-fi movie classics'),
('Action', 'Examining iconic action movie moments'),
('Drama', 'Thoughtful analysis of dramatic film moments'),
('Animation', 'Exploring animated film classics'),
('Thriller', 'Analysis of psychological thrillers and complex villains'),
('Superhero', 'Exploring superhero movie moments and character development');

-- Then insert posts with their categories
INSERT INTO blog_posts (category_id, user_id, title, content, created_at) VALUES
(1, 1, 'The Godfather: An Offer You Can''t Refuse',
'In the iconic scene from The Godfather (1972), Don Vito Corleone delivers the immortal line, "I''m going to make him an offer he can''t refuse." This quote embodies the essence of power, negotiation, and the subtle art of persuasion that permeates throughout the entire film. The beauty of this line lies not just in its delivery by Marlon Brando, but in its deeper implications about the nature of power and control in the criminal underworld. The "offer" isn''t really an offer at all - it''s a threat veiled in the language of business negotiation. This quote has become so deeply embedded in popular culture that it''s often used humorously in everyday situations, but in the context of the film, it carries the weight of life and death. The scene perfectly illustrates how Don Corleone operates: with a quiet, almost gentle demeanor that barely conceals the iron fist beneath the velvet glove. This duality - the civilized businessman versus the ruthless crime boss - is at the heart of the film''s exploration of power, family, and the American Dream.',
'2025-06-28 14:30:00'),

(2, 3, 'Here''s Looking At You, Kid: The Romance of Casablanca',
'When Rick Blaine utters "Here''s looking at you, kid" to Ilsa in Casablanca (1942), he captures the essence of bittersweet romance that defines this classic film. The phrase, seemingly simple, carries layers of meaning that deepen with each repetition throughout the movie. It''s first used in Paris during their happy times, then again in Casablanca as they reunite, and finally at the airport in their farewell scene. Humphrey Bogart''s delivery makes it more than just a toast - it''s a declaration of enduring love, a recognition of sacrifice, and ultimately, a goodbye. The phrase wasn''t even in the original script; it was something Bogart used to say to Ingrid Bergman while teaching her poker between takes. This improvised line became one of cinema''s most memorable quotes, embodying the perfect blend of casual American slang and profound emotional resonance. It''s a masterclass in how the simplest words can carry the greatest weight when delivered in the right context.',
'2025-06-28 15:45:00'),

(3, 5, 'May the Force Be With You: The Philosophy of Star Wars',
'The phrase "May the Force be with you" from Star Wars (1977) transcends its science fiction origins to become a modern blessing, a spiritual mantra for generations of viewers. George Lucas created the concept of the Force as an amalgamation of various religious and philosophical traditions, making it both familiar and mysterious. The phrase itself serves multiple purposes: it''s a farewell, a good luck wish, and a reminder of the interconnected nature of all things. When Obi-Wan Kenobi first explains the Force to Luke Skywalker, he describes it as "an energy field created by all living things. It surrounds us and penetrates us; it binds the galaxy together." This description elevates the entire space opera beyond mere adventure into the realm of spiritual journey. The quote has become so ingrained in popular culture that it''s used far beyond its original context, serving as a universal expression of good wishes and solidarity.',
'2025-06-28 16:20:00'),

(4, 2, 'I''ll Be Back: The Promise of The Terminator',
'Arnold Schwarzenegger''s delivery of "I''ll be back" in The Terminator (1984) transformed three simple words into one of cinema''s most memorable promises. The genius of this line lies in its dual nature - it''s both a straightforward statement and a chilling threat. When first delivered, it seems like a throwaway line, but it becomes a recurring motif throughout the franchise. The mechanical precision of Schwarzenegger''s delivery perfectly encapsulates the character''s nature: a relentless machine that cannot be reasoned with or stopped. Director James Cameron originally wanted to use "I''ll come back," but Schwarzenegger insisted on "I''ll be back" despite his difficulty pronouncing it due to his accent. This happy accident created a quote that''s been referenced and parodied countless times, becoming a cultural touchstone that transcends its sci-fi origins.',
'2025-06-28 17:10:00'),

(5, 2, 'Life Is Like a Box of Chocolates: The Wisdom of Forrest Gump',
'Forrest Gump''s mother''s wisdom, "Life is like a box of chocolates, you never know what you''re gonna get," captures the unpredictable nature of existence in a beautifully simple metaphor. This quote from Forrest Gump (1994) resonates because it acknowledges both the surprise and uncertainty that life presents us with. The metaphor works on multiple levels - like a box of chocolates, life offers various experiences, some sweet, some bitter, some unexpected. The quote gains additional poignancy through Tom Hanks'' delivery as Forrest, a character whose entire life story is a testament to the unexpected turns that fate can take. What makes this quote particularly effective is its accessibility - everyone can understand the reference to a box of chocolates, making complex philosophical ideas about fate and uncertainty immediately relatable to the average person.',
'2025-06-28 18:05:00'),
    
(6, 2, 'To Infinity and Beyond: The Spirit of Adventure',
'Buzz Lightyear''s catchphrase "To infinity and beyond!" from Toy Story (1995) encapsulates the boundless optimism and adventurous spirit that defines both childhood and human aspiration. The phrase is deliberately contradictory - how can one go beyond infinity? - but that''s precisely what makes it powerful. It suggests that even the impossible is achievable, that there are no real limits to what we can accomplish. The line works on multiple levels: for children, it''s an exciting catchphrase that captures their imagination; for adults, it''s a reminder of the importance of dreaming big and pushing boundaries. Through Buzz''s character arc, we see how this phrase transforms from a pre-programmed slogan into a genuine expression of adventurous spirit and friendship.',
'2025-06-28 19:00:00'),

(7, 2, 'Why So Serious?: The Philosophy of Chaos',
'The Joker''s question "Why so serious?" from The Dark Knight (2008) is more than just a catchphrase - it''s a philosophical challenge to society''s established order. Heath Ledger''s delivery makes this simple question into something deeply unsettling, forcing both the characters and the audience to confront their assumptions about chaos and control. The quote serves as a perfect encapsulation of the Joker''s character: playful on the surface but with dangerous depths lurking beneath. It''s typically delivered before or after moments of extreme violence, creating a disturbing juxtaposition between the lighthearted phrase and its dark context. The question itself challenges Batman''s grim approach to justice and society''s rigid structures, suggesting that chaos might be more natural than order.',
'2025-06-28 20:15:00'),

(8, 2, 'I Am Iron Man: The Evolution of Tony Stark',
'The declaration "I am Iron Man" bookends Tony Stark''s journey in the Marvel Cinematic Universe, first appearing in Iron Man (2008) and culminating in Avengers: Endgame (2019). This phrase represents more than just a superhero reveal - it''s a statement of identity and purpose. When first uttered at the press conference in Iron Man, it''s a moment of characteristic Tony Stark bravado, breaking the superhero tradition of secret identities. By the time it''s repeated in Endgame, it has transformed into something much more profound - a statement of sacrifice and heroism. The evolution of this phrase mirrors Stark''s own character development from self-centered billionaire to self-sacrificing hero. The power of these words lies in their simplicity and their ability to carry different meanings depending on their context.',
'2025-06-28 21:30:00');
