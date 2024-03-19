# Chart
Using mermaid to create chart. More details here: https://mermaid.js.org/intro/

Blue = Waiting,
Green = Done,
Red = Issue/Halt

```mermaid
graph TD;
    classDef toBeDone fill:#00f
    classDef completed fill:#153,stroke:#000
    classDef halted fill:#f00

    %%Area for designating colours, Use above classes to colour
    A:::completed

    B5:::toBeDone
    F5:::toBeDone

    %%To add new boxes give them an ID i.e A4 or B7 or something and define the text within the square brackets

    %%Area to define the text within the boxes
    A[Start]

    %%Backend branch boxes
    B5[Create Database Reltionships]
    B10[Working Backend]

    %%Frontend boces
    F5[Mockup Website]
    F10[Working Frontend]

    %%End box
    Z[Released Application]

    %%Graph definition
    A-->B5
    A-->F5

    B5-->B10
    B10-->Z

    F5-->F10
    F10-->Z
        
    
```
