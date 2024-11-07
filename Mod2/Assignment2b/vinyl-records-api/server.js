const express = require("express");
const app = express();
const port = 3000;

app.use('/images', express.static('images'));

const records = [
    {Id: 1, title: "(What's The Story) Morning Glory", artist: "Oasis", year: "1995", genre: "Rock", type: "Album", image: "/images/morningGlory.jpg"},
    {Id: 2, title: "Definitely Maybe", artist: "Oasis", year: "1994", genre: "Rock", type: "Album", image: "/images/definitelyMaybe.jpg"},
    {Id: 3, title: "Pony", artist: "Rex Orange County", year: "2019", genre: "Indie Rock", type: "Album", image: "/images/Pony.jpg"},
    {Id: 4, title: "This Place Sucks Ass", artist: "PUP", year: "2020", genre: "Punk", type: "EP", image: "/images/TPSA.jpg"},
    {Id: 5, title: "The Dream Is Over", artist: "PUP", year: "2016", genre: "Punk", type: "Album", image: "/images/theDreamIsOver.jpg"},
    {Id: 6, title: "Morbid Stuff", artist: "PUP", year: "2019", genre: "Punk", type: "Album", image: "/images/morbidStuff.jpg"},
    {Id: 7, title: "PUP", artist: "PUP", year: "2013", genre: "Punk", type: "Album", image: "/images/PUP.jpg"},
    {Id: 8, title: "Now And Then / Love Me Do", artist: "The Beatles", year: "2023", genre: "Rock", type: "Single", image: "/images/nowAndThen.jpg"},
    {Id: 9, title: "Revolver", artist: "The Beatles", year: "1966", genre: "Rock", type: "Album", image: "/images/Revolver.jpg"},
    {Id: 10, title: "Let It Be", artist: "The Beatles", year: "1970", genre: "Rock", type: "Album", image: "/images/letItBe.jpg"},
    {Id: 11, title: "The Beatles (White Album)", artist: "The Beatles", year: "1968", genre: "Rock", type: "Album", image: "/images/whiteAlbum.jpg"},
    {Id: 12, title: "1962-1966", artist: "The Beatles", year: "1973", genre: "Rock", type: "Album", image: "/images/1962-1966.jpg"},
    {Id: 13, title: "1967-1970", artist: "The Beatles", year: "1973", genre: "Rock", type: "Album", image: "/images/1967-1970.jpg"},
    {Id: 14, title: "This Is Why", artist: "Paramore", year: "2023", genre: "Alternative Rock", type: "Album", image: "/images/thisIsWhy.jpg"},
    {Id: 15, title: "Worry", artist: "Jeff Rosenstock", year: "2016", genre: "Punk", type: "Album", image: "/images/Worry.jpg"}
];

app.get("/api/records", (req, res) => {
    const page = parseInt(req.query.page) || 1;
    const limit = parseInt(req.query.limit) || 2;
    const startIndex = (page - 1) * limit;
    const endIndex = startIndex + limit;

    const result = {
        next: endIndex < records.length ? page + 1 : null,
        previous: startIndex > 0 ? page - 1 : null,
        data: records.slice(startIndex, endIndex)
    };
    res.json(result);
});

app.listen(port, () => {
    console.log(`API server running on http://localhost:${port}`);
});
