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
    
    A:::completed
    B:::toBeDone
    C:::toBeDone
    D:::toBeDone
    
    A[Start]-->B[Working Frontend];
    A-->C[Working Backend];
    B-->D;
    C-->D[Working FeedTrac];
    
    
```
