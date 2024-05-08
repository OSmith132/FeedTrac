# Chart
Using mermaid to create chart. More details here: https://mermaid.js.org/intro/
```mermaid

graph TD;

%% Frontend Tasks (Before 23/04/2024)
    X1-->A1
    A1-->A2
    A2-->A3
    A3-->M1

    X1[Start]
    A1[CSS/HTML]
    A2[Login Screen]
    A3[Webpage Creation]
    %% merge here

    M1-->A4
    A4-->A5
    A5-->M2

    A4[Light/Dark Mode]
    A5[LoginPage]
    %% merge here
    
    M2-->A6
    
    A6[Indexpage]
    %% merge
    
    A6-->M3
    
    A7[Setttings dropdown]
    A8[Profile Page]
    A9[Password Visibility Toggle]
    
    M3-->A7
    A7-->A8
    A8-->A9
    A9-->A10
    A10-->M4
    
    A7[Profile Picture]
    A8[Profile Details]
    A9[Profile Bio]
    A10[Settings Page]
   
    M4-->A11
    
    A11[Like System]

    A11-->M5

%% Backend Tasks (Before 23/04/2024)
    X1-->C1
    C1-->C2
    C2-->C3
    C3-->C4
    C4-->C5
    C5-->M1

    C1[Server/Database Setup]
    C2[Database Design]
    C3[Database Constraints]
    C4[Database Storage]
    C5[Basic Functionality]
    %%merge here
    M1[Merge and Test]

   M1-->C6
   C6-->C7
   C7-->C8
   C8-->C9
   C9-->M2
   
    C6[Database Wrapper Class]
    C7[MVC Design Pattern]
    C8[_POST Handling]
    C9[Login/Signup Classes]
    %% merge here
    M2[Merge and Test] 
    
    M2-->C10
    C10-->C11
    C11-->C12
    C12-->M3
    
    C10[Feedback Reports]
    C11[Homepage Table Update]
    C12[Clickable Rows]
    M3[Merge and Test]
    
    M3-->C13
    C13-->C14
    C14-->C15
    C15-->C16
    C16-->C17
    C17-->C18
    C18-->C19
    C19-->M4

    C13[Profile Picture Folder]
    C14[Profile Picture Upload]
    C15[Login View]
    C16[User Data Retrieval]
    C17[User bio added to database]
    C18[Password Recovery]
    C19[Recovery Table]
    
    M4[Merge and Test]
    
    M4-->C20
    C20-->C21
    C21-->C22
    C22-->M5
     
    M5-->D1
    D1-->X2
    
    
    C20[Homepage Search/Filter]
    C21[User rating table]
    C22[User rating implementation]
    M5[Merge and Test]

    D1[Final Testing]
    X2[End]




    
    

